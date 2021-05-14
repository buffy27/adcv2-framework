<?php


namespace App\Controller;


use App\Entity\Rss;
use App\Entity\SyncAnnounce;
use App\Entity\Torrents;
use App\Services\Functions;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Rhilip\Bencode\Bencode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RssFeed extends AbstractController
{
    private $entityManager;
    private $functions;

    private $headers = [
        'Content-Type' => 'text/xml'
    ];

    public function __construct(EntityManagerInterface $entityManager, Functions $functions)
    {
        $this->entityManager = $entityManager;
        $this->functions = $functions;
    }

    /**
     * @Route ("/rss", name="rss")
     */
    public function rss(Request $request){
        $rss_generated = $this->entityManager->getRepository(Rss::class)->findBy([
            'user' => $this->getUser()
        ]);
        if($request->request->get('generate')) {
            if ($request->request->get('categories')) {
                $rss = new Rss();
                $rss->setUser($this->getUser());
                $rss->setCategories($request->request->get('categories'));
                $rss->setDisplay($request->request->get('display') ?? []);
                $rss->setNumwat($request->request->get('numwat'));
                $rss->setRssHash(hash('sha3-256', random_bytes(5) . rand(128,256)));
                $this->entityManager->persist($rss);
                $this->entityManager->flush();
                return new RedirectResponse($this->generateUrl('rss'));
            }
            $error = "Select a category";
        }
        return $this->render('tracker/rss.html.twig',[
            'error' => $error ?? null,
            'rss_generated' => $rss_generated
        ]);
    }

    /**
     * @Route ("/rss_feed/{rss_hash}", name="rss.feed")
     */
    public function rss_feed($rss_hash, Request $request){
        $rss_out = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
        $rss_out .= "<rss version=\"2.0\">";
        $rss_out .= "<channel><title>" . $request->getScheme() . "</title>";
        $rss_out .= "<description>Torrents</description>";
        $rss_out .= "<link><![CDATA['" . $request->getSchemeAndHttpHost() . "]]></link>";
        $rss_out .= "<copyright>Asian DVD Club | Back since 2020</copyright>";

        $rss = $this->entityManager->getRepository(Rss::class)->findOneBy([
           'rss_hash' => $rss_hash
        ]);

        if(!$rss){
            $rss_out .= "<rss version=\"2.0\">";
            $rss_out .= "<channel><title>" . $request->getScheme() . "</title>";
            $rss_out .= "<description>RSS not found</description>";
            $rss_out .= "<link><![CDATA['" . $request->getSchemeAndHttpHost() . "]]></link>";
            $rss_out .= "</rss>";
            return new Response($rss_out, 200, $this->headers);
        }

        /** @var \Doctrine\ORM\QueryBuilder  $torrents */
        $torrents = $this->entityManager->getRepository(Torrents::class)->createQueryBuilder('t');

        $categories = $rss->getCategories();
        $display = $rss->getDisplay();
        for ($i = 0; $i < count($categories); $i++) {
            $torrents->orWhere('t.tCategory = :cat_' . $i);
            $torrents->setParameter('cat_' . $i, $categories[$i]);
        }
        $torrents->groupBy('t');
        $torrents->orderBy('t.added', 'DESC');
        $result = $torrents->getQuery()
            ->setMaxResults($rss->getNumwat())
            ->getResult()
        ;

        foreach ($result as $value){
            $rss_out .= "<item><title>" . $value->getName() . " ";
            if(in_array("uploader", $display)){
                $rss_out .= $value->getOwner()->getUsername();
            }
            if(in_array("size", $display)){
                $rss_out .= " " . $this->functions->formatBytes($value->getSize());
            }
            $rss_out .= "</title>";
            $rss_out .= "<description><![CDATA['";
            if(in_array("description", $display))
                $rss_out .= "<pre>" . $value->getDescription() . "</pre>";
            if(in_array("mediainfo", $display) && $value->getMediaInfo())
                $rss_out .= "<pre>" . $value->getMediaInfo() . "</pre>";
            if(in_array("image", $display))
                $rss_out .= "<img src='" . $request->getSchemeAndHttpHost() . $this->generateUrl('torrent.poster', ['id'=>$value->getId()]) . "'>";
            $rss_out .= "']]></description>";
            $rss_out .= "<link>" . $request->getSchemeAndHttpHost() . $this->generateUrl('torrent.poster', ['id'=>$value->getId()]) . "</link>";
            $rss_out .= "<enclosure type=\"application/x-bittorrent\" length=\"" . $value->getSize() . "\" url=\"" . $request->getSchemeAndHttpHost() .  $this->generateUrl('rss.torrent', ['tid' => $value->getId(), 'rss_hash' => $rss_hash]). "\"/>";
            //$rss_out .= "<media:hash algo=\"sha1\"><" . $value['info_hash'] . "/media:hash>";
            $rss_out .= "</item>";
        }

        $rss_out .= "</channel></rss>";
        return new Response($rss_out, 200, $this->headers);
    }

    /**
     * @Route ("/rss_torrent/{tid}/{rss_hash}", name="rss.torrent", requirements={"tid"="\d+"})
     */
    public function rss_torrent($rss_hash, $tid, Request $request){

        $rss = $this->entityManager->getRepository(Rss::class)->findOneBy(['rss_hash' => $rss_hash]);

        $torrent = $this->entityManager->getRepository(Torrents::class)->find($tid);
        if(!$torrent)
            return new JsonResponse(['error' => "Torrent not found"]);
        $sync_announce = $this->entityManager->getRepository(SyncAnnounce::class)->getSyncAnnounce($rss->getUser(), $torrent);
        if(!$sync_announce) {
            $data_passkey = hash("SHA3-512", $rss->getUser()->getSecret() . random_bytes(8) . $rss->getUser()->getPasskey() . random_bytes(16));
            $sync = new SyncAnnounce();
            $sync->setUser($rss->getUser());
            $sync->setTorrent($torrent);
            $sync->setDataPasskey($data_passkey);
            $sync->setAdded();
            $this->entityManager->persist($sync);
            $this->entityManager->flush();
        }else{
            $data_passkey = $sync_announce[0]->getDataPasskey();
        }

        $path = $this->getParameter("kernel.project_dir") . "/data/torrents/" . $torrent->getInfoHash(). ".torrent";
        $torrentFile = Bencode::load($path);
        $torrentFile['announce'] = $request->getSchemeAndHttpHost() .  "/announce/" .$data_passkey;

        $headers = [
            'Content-Type' => 'application/x-bittorrent; charset=UTF-8',
            'Content-Description' => 'File Transfer',
            'Pragma' => 'public',
            'Content-Disposition' => 'attachment; filename="' . $torrent->getName() . '.torrent"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        ];
        $file = Bencode::encode($torrentFile);

        return new Response($file,200, $headers);
    }
}