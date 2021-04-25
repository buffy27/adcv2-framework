<?php

namespace App\Controller;

use App\Entity\Peers;
use App\Entity\SyncAnnounce;
use App\Entity\TorrentComments;
use App\Entity\Torrents;
use App\Entity\TorrentsCategory;
use App\Entity\XbtFilesUsers;
use App\Form\UploadFormType;
use App\Form\UploadPreviewFormType;
use App\Libraries\AnnounceFunctions;
use App\Libraries\TorrentFile;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use phpDocumentor\Reflection\Types\This;
use Rhilip\Bencode\Bencode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use function Twig\Extra\Markdown\twig_html_to_markdown;
use function Webmozart\Assert\Tests\StaticAnalysis\fileExists;
use function Webmozart\Assert\Tests\StaticAnalysis\nullOrIsEmpty;

class TrackerController extends AbstractController
{
    private $entityMangaer;
    private $announce;

    public function __construct(EntityManagerInterface $entityManager, AnnounceFunctions $announce)
    {
        $this->entityMangaer = $entityManager;
        $this->announce = $announce;
    }

    /**
     * @Route("/torrents", name="torrents", methods={"GET"} )
     */
    public function torrents(Request $request, SessionInterface $session): Response
    {
        /*
         * Search mapping
         * searchbox, search_desc, bookmarked, completed, my_uploads, seeds_needed, bdmv, uhd, golden, silver
         */
        //$torrents = $this->entityMangaer->getRepository(Torrents::class)->findAll();
        /** @var QueryBuilder $torrents */
        $torrents = $this->entityMangaer->getRepository(Torrents::class)->createQueryBuilder('t');
        if($request->query->get('search')){
            $session->set('search', $request->query->all());
        }
        if($request->query->get('reset')){
            $session->remove('search');
        }

        if(isset($session->get('search')['searchbox']) && !empty($session->get('search')['searchbox'] && !isset($session->get('search')['search_desc']))){
            $search = explode(' ', $session->get('search')['searchbox']);
            for ($i = 0; $i < count($search); $i++) {
                $torrents->andWhere(' LOWER(t.name) LIKE LOWER(CONCAT(\'%\', :word_' . $i . ',\'%\'))');
                $torrents->setParameter('word_' . $i, $search[$i]);
            }
        }

        if(isset($session->get('search')['searchbox']) && !empty($session->get('search')['searchbox'] && isset($session->get('search')['search_desc']))){
            $search = explode(' ', $session->get('search')['searchbox']);
            for ($i = 0; $i < count($search); $i++) {
                $torrents->andWhere(' LOWER(t.name) LIKE LOWER(CONCAT(\'%\', :word_' . $i . ',\'%\')) OR LOWER(t.description) LIKE LOWER(CONCAT(\'%\', :word_desc_' . $i . ',\'%\')) OR LOWER(t.contentInfo) LIKE LOWER(CONCAT(\'%\', :word_content_' . $i . ',\'%\'))');
                $torrents->setParameter('word_' . $i, $search[$i]);
                $torrents->setParameter('word_desc_' . $i, $search[$i]);
                $torrents->setParameter('word_content_' . $i, $search[$i]);
            }
        }
        //comact this
        if(isset($session->get('search')['golden']) && isset($session->get('search')['silver'])){
            $torrents->andWhere('t.bonus = \'freeleech\' OR t.bonus = \'silver\'');
        }else {
            if (isset($session->get('search')['golden'])) {
                $torrents->andWhere('t.bonus = \'freeleech\'');
            }

            if (isset($session->get('search')['silver'])) {
                $torrents->andWhere('t.bonus = \'silver\'');
            }
        }

        if(isset($session->get('search')['my_uploads'])){
            $torrents->andWhere('t.owner = :user');
            $torrents->setParameter('user', $this->getUser());
        }
        if(isset($session->get('search')['categories'])){
            $categories = $request->query->get('categories');
            $sql = "";
            for ($i = 0; $i < count($categories); $i++) {
                if(isset($session->get('search')['search_desc'])){
                    $sql .= $i == 0 ? 't.tCategory = :cat_' . $i : ' OR t.tCategory = :cat_' . $i;
                }else {
                    $torrents->orWhere('t.tCategory = :cat_' . $i);
                    $torrents->setParameter('cat_' . $i, $categories[$i]);
                }
            }
            if(!empty($sql)){
                $torrents->andWhere($sql);
                for ($i = 0; $i < count($categories); $i++) {
                    $torrents->setParameter('cat_' . $i, $categories[$i]);
                }
            }
        }

        $expr = $this->entityMangaer->getExpressionBuilder();
        // AND opperator between search box and the left boxes
        if(isset($session->get('search')['search_desc'])){
            $sql = "";
            if(isset($session->get('search')['dvd'])){
                $sql .= 'JSON_EXTRACT(t.specs, \'$.format\') = \'dvd\'';
            }
            if(isset($session->get('search')['bdmv'])){
                $sql .= ' OR JSON_EXTRACT(t.specs, \'$.format\') = \'bdmv\'';
            }
            if(isset($session->get('search')['uhd'])){
                $sql .= ' OR JSON_EXTRACT(t.specs, \'$.format\') = \'uhd\'';
            }
            if(!empty($sql))
            $torrents->andWhere($sql);
        }else{
            if(isset($session->get('search')['dvd'])){
                $torrents->orWhere('JSON_EXTRACT(t.specs, \'$.format\') = \'dvd\'');
            }
            if(isset($session->get('search')['bdmv'])){
                $torrents->orWhere('JSON_EXTRACT(t.specs, \'$.format\') = \'bdmv\'');
            }
            if(isset($session->get('search')['uhd'])){
                $torrents->orWhere('JSON_EXTRACT(t.specs, \'$.format\') = \'uhd\'');
            }
        }

        dump($session->get('search'));
        $torrents = $torrents->getQuery()->getResult();
        return $this->render('tracker/torrents.html.twig', [
            'torrents' => $torrents,
            'search_session' => $session->get('search')
        ]);
    }

    /**
     * @Route("/torrent/{id}", name="torrent", requirements={"id"="\d+"})
     */
    public function torrent($id, Request $request): Response
    {
        $torrent = $this->entityMangaer->getRepository(Torrents::class)->find($id);
        if(!$torrent)
            return $this->render("errors/tracker_error.html.twig", ['error' => "Torrent with id " . $id . " was not found in database"]);
        $comments = $this->entityMangaer->getRepository(TorrentComments::class)->findByTorrentId($torrent);
        $peers = $this->entityMangaer->getRepository(Peers::class)->findByTorrent($torrent->getId());

        $stats = $this->entityMangaer->getRepository(Peers::class)->getPeersCountByUser($this->getUser());

        if($request->getMethod() == "POST"){
            $comment = new TorrentComments();
            $comment->setComment($request->get('comment_desc'));
            $comment->setAdded(new \DateTime("now"));
            $comment->setTorrents($torrent);
            $comment->setUser($this->getUser());
            $this->entityMangaer->persist($comment);
            $this->entityMangaer->flush();
            return new RedirectResponse($this->generateUrl('torrent', ['id' => $id]));
        }
        
        return $this->render('tracker/torrent.html.twig', [
            'torrent' => $torrent,
            'torrent_details' => array_flip($this->getUser()->getTrackerSettings()['torrent_details']),
            'comments' => $comments,
            'peers' => $peers,
            'stats' => $stats //TODO important move this to global with https://symfony.com/doc/current/templating/global_variables.html (create service stats)
        ]);
    }

    /**
     * @param $id
     * @Route ("/torrent/remove/{id}", name="torrent.remove", requirements={"id"="\d+"}, methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function torrent_remove($id): Response
    {
        $torrent = $this->entityMangaer->getRepository(Torrents::class)->find($id);
        if(!$torrent)
            return $this->render("errors/tracker_error.html.twig", ['error' => "Torrent with id " . $id . " was not found in database"]);
        /*
        $error = isset($this->announce->deleteTorrent($torrent->getInfoHash())['error']) ? $this->announce->deleteTorrent($torrent->getInfoHash())['error'] : null;
        if(isset($error)){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => $error
            ]);
        }*/

        unlink($this->getParameter("kernel.project_dir") . "/data/torrents/" . $torrent->getInfoHash(). ".torrent");
        $this->entityMangaer->remove($torrent);
        $this->entityMangaer->flush();
        return $this->render("tracker/info.html.twig", ["info" => "Torrent has been removed"]);
    }

    /**
     * @param $id
     * @Route ("/torrent/download/{id}", name="torrent.download", requirements={"id"="\d+"})
     */
    public function torrent_download($id, Request $request){
        $torrent = $this->entityMangaer->getRepository(Torrents::class)->find($id);
        if(!$torrent)
            return $this->render("errors/tracker_error.html.twig", ['error' => "Torrent with id " . $id . " was not found in database"]);
        $sync_announce = $this->entityMangaer->getRepository(SyncAnnounce::class)->getSyncAnnounce($this->getUser(), $torrent);
        if(!$sync_announce) {
            $data_passkey = hash("SHA3-512", $this->getUser()->getSecret() . random_bytes(8) . $this->getUser()->getPasskey() . random_bytes(16));
            $sync = new SyncAnnounce();
            $sync->setUser($this->getUser());
            $sync->setTorrent($torrent);
            $sync->setDataPasskey($data_passkey);
            $sync->setAdded();
            $this->entityMangaer->persist($sync);
            $this->entityMangaer->flush();
        }else{
            $data_passkey = $sync_announce[0]->getDataPasskey();
        }
        /*
        $error = isset($this->announce->addUser($data_passkey, $this->getUser()->getId())['error']) ? $this->announce->addUser($data_passkey, $this->getUser()->getId())['error'] : null;

        if(isset($error)){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => $error
            ]);
        }*/
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

    /**
     * @Route ("/upload", name="upload", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request): Response
    {
        $uploader = $this->getUser();
        $categories = $this->entityMangaer->getRepository(TorrentsCategory::class)->findAllNames();
        $form = $this->createForm(UploadFormType::class, ['categories' => $categories]);
        $form->handleRequest($request);

        $torrentData = [];
        $upload_form = $request->request->get('upload_form');

        if(!empty($request->files->get('upload_form')['torrent_file'])) {
            $torrentFile = new TorrentFile($request->files->get('upload_form')['torrent_file']);
            if (!isset($upload_form['torrent_name']) && $torrentFile->getTorrentFile())
                $torrentData['name'] = $torrentFile->getTorrentFile()['info']['name'];
            else
                $torrentData['name'] = $upload_form['torrent_name'];

            if ($torrentFile->getTorrentFile()) {
                $torrentData['size'] = $torrentFile->getTorrentSize();
                $torrentData['files'] = $torrentFile->getTorrentFiles();
            }
        }
        if($request->getMethod() == "POST" && isset($_POST['preview'])){
            if(isset($torrentData['size']))
                $torrentData['size'] = $this->getSize($torrentData['size']);
            else {
                $torrentData['size'] = "---";
                $torrentData['files']['total'] = "---";
                $torrentData['files']['info_hash'] = "---";
                $torrentData['name'] = "---";
            }
            return new JsonResponse($torrentData);
        }

        if($form->isSubmitted() && $form->isValid()){
            $torrent_file = new TorrentFile($form->get('torrent_file')->getData());
            $formData = $form->getData();
            $checkFile = $this->getParameter('kernel.project_dir') . "/data/torrents/" . $torrent_file->getTorrentFiles()['info_hash'] . ".torrent";
            if(file_exists($checkFile)){
                $form->get('torrent_file')->addError(new FormError("Torrent already exists in database"));
            }else{
                $category = $this->entityMangaer->getRepository(TorrentsCategory::class)->find($formData['tCategory']);
                $torrent = new Torrents();
                $torrent->setOwner($uploader);
                $torrent->setInfoHash($torrent_file->getTorrentFiles()['info_hash']);
                $torrent->setTCategory($category);
                $torrent->setAdded();
                $torrent->setSeeders();
                $torrent->setLeechers();
                $torrent->setSize($torrent_file->getTorrentSize());
                $torrent->setBonus();
                $torrent->setBalance(0);
                $torrent->setSnatched(0);
                $torrent->setDoubleTorrent(0);
                $torrent->setLastAction();
                $torrent->setSpecs([
                    "type" => $category->getName(),
                    "format" => $request->get('template_radio')
                ]);
                $torrent->setDescription($formData['release_details']);
                $torrent->setContentInfo($formData['content_info']);
                if(isset($formData['torrent_name']))
                    $torrent->setName($formData['torrent_name']);
                else
                    $torrent->setName($torrent_file->getTorrentFile()['info']['name']);
                $torrent->setContentPoster($formData['content_poster']);
                if(isset($formData['mediainfo']))
                    $torrent->setMediaInfo($formData['mediainfo']);
                $torrent->setContentUrl($formData['content_url']);
                unset($formData);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($torrent);
                $entityManager->flush();
                $torrentFile->makeTorrentFile($this->getParameter('kernel.project_dir'));
                /*
                $error = isset($this->announce->addTorrent($torrent->getId(), $torrent->getInfoHash())['error']) ? $this->announce->addUser($torrent->getId(), $torrent->getInfoHash())['error'] : null;

                if(isset($error)){
                    return $this->render('errors/tracker_error.html.twig', [
                        'error' => $error
                    ]);
                }*/

                return new RedirectResponse($this->generateUrl('torrent', ['id' => $torrent->getId()]));
            }
        }
        return $this->render('tracker/upload.html.twig', [
            'uploadForm' => $form->createView(),
            'user' => $uploader,
            'announce' => $request->getSchemeAndHttpHost(),
        ]);
    }
    private function getSize($size){
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
