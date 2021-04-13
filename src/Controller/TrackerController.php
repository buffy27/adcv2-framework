<?php

namespace App\Controller;

use App\Entity\Peers;
use App\Entity\SyncAnnounce;
use App\Entity\TorrentComments;
use App\Entity\Torrents;
use App\Entity\TorrentsCategory;
use App\Form\UploadFormType;
use App\Form\UploadPreviewFormType;
use App\Libraries\TorrentFile;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Rhilip\Bencode\Bencode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use function Twig\Extra\Markdown\twig_html_to_markdown;
use function Webmozart\Assert\Tests\StaticAnalysis\fileExists;
use function Webmozart\Assert\Tests\StaticAnalysis\nullOrIsEmpty;

class TrackerController extends AbstractController
{
    private $entityMangaer;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityMangaer = $entityManager;
    }

    /**
     * @Route("/torrents", name="torrents", methods={"GET","HEAD"} )
     */
    public function torrents(Request $request): Response
    {
        $torrents = $this->entityMangaer->getRepository(Torrents::class)->findAll();
        return $this->render('tracker/torrents.html.twig', [
            'torrents' => $torrents
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
        $peers = $this->entityMangaer->getRepository(Peers::class)->findByTorrent($torrent);
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
        $path = $this->getParameter("kernel.project_dir") . "/data/torrents/" . $torrent->getInfoHash(). ".torrent";
        $torrentFile = Bencode::load($path);
        $torrentFile['announce'] = $request->getSchemeAndHttpHost() . "/announce/" . $data_passkey;

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
            $checkFile = $this->getParameter('kernel.project_dir') . "/data/torrents" . $torrent_file->getTorrentFiles()['info_hash'] . ".torrent";
            if($torrent_file->getTorrentFile()['announce'] != $request->getSchemeAndHttpHost() . "/announce")
                $form->get('torrent_file')->addError(new FormError("Invalid announce"));
            else if(file_exists($checkFile)){
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
                $torrent->setBonus('normal');
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
