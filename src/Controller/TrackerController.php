<?php

namespace App\Controller;

use App\Entity\TorrentComments;
use App\Entity\Torrents;
use App\Entity\TorrentsCategory;
use App\Form\UploadFormType;
use App\Form\UploadPreviewFormType;
use App\Libraries\TorrentFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
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
    public function torrents(): Response
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
        $comments = $this->entityMangaer->getRepository(TorrentComments::class)->findByTorrentId($torrent);
        dump($comments);
        if($request->getMethod() == "POST"){
            $comment = new TorrentComments();
            $comment->setComment($request->get('comment_desc'));
            $comment->setAdded(new \DateTime("now"));
            $comment->setTorrents($torrent);
            $comment->setUser($this->getUser());
            $this->entityMangaer->persist($comment);
            $this->entityMangaer->flush();
        }


        return $this->render('tracker/torrent.html.twig', [
            'torrent' => $torrent,
            'user' => $this->getUser(),
            'comments' => $comments
        ]);
    }

    /**
     * @Route ("/upload", name="upload", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request, HttpClientInterface $client): Response
    {
        $uploader = $this->getUser();
        if($request->getMethod() == "POST" && $request->get('preview')) {
            return $this->redirectToRoute('upload.preview', [
                'request' => $request
            ], 307);
        }

        $categories = $this->entityMangaer->getRepository(TorrentsCategory::class)->findAllNames();
        $form = $this->createForm(UploadFormType::class, ['categories' => $categories]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $torrent_file = new TorrentFile($form->get('torrent_file')->getData());
            $formData = $form->getData(); //TODO use this instead of get
            $checkFile = $this->getParameter('kernel.project_dir') . "/data/torrents" . $torrent_file->getTorrentFiles()['info_hash'] . ".torrent";
            if($torrent_file->getTorrentFile()['announce'] != $request->getSchemeAndHttpHost() . "/announce")
                $form->get('torrent_file')->addError(new FormError("Invalid announce"));
            else if(file_exists($checkFile)){
                $form->get('torrent_file')->addError(new FormError("Torrent already exists in database"));
            }else{
                $category = $this->entityMangaer->getRepository(TorrentsCategory::class)->find($form->get('tCategory')->getData());
                $api = new ApiController();
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
                $torrent->setDescription($form->get('release_details')->getData());
                $torrent->setContentInfo($form->get('content_info')->getData());
                $torrent->setContentId($api->getScrapperId($request->get('format_type'), $request->get('content_id')));
                if($form->get('torrent_name')->getData())
                    $torrent->setName($form->get('torrent_name')->getData());
                else
                    $torrent->setName($torrent_file->getTorrentFile()['info']['name']);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($torrent);
                $entityManager->flush();
                return new RedirectResponse($this->generateUrl('torrent', ['id'=>$torrent->getId()]));
            }
        }

        return $this->render('tracker/upload.html.twig', [
            'uploadForm' => $form->createView(),
            'user' => $uploader,
            'announce' => $request->getSchemeAndHttpHost()
        ]);
    }
    /**
     * @Route ("/upload/preview", name="upload.preview")
     * @param Request $request
     * @return Response
     */
    public function preview(Request $request): Response
    {
        $torrentData = [];
        $upload_form = $request->request->get('upload_form');
        $torrentFile = new TorrentFile($request->files->get('upload_form')['torrent_file']);

        if(!$upload_form['torrent_name'] && $torrentFile->getTorrentFile())
            $torrentData['name'] = $torrentFile->getTorrentFile()['info']['name'];
        else
            $torrentData['name'] = $upload_form['torrent_name'];

        if($torrentFile->getTorrentFile()) {
            $torrentData['size'] = $torrentFile->getTorrentSize();
            $torrentData['files'] = $torrentFile->getTorrentFiles();
        }

        dump($request);
        return $this->render('tracker/upload_preview.html.twig', [
            'user' => $this->getUser(),
            'upload' => $upload_form,
            'request' => $request,
            'image_url' => $request->get('image_url'),
            'torrent_data' => $torrentData
        ]);
    }


}
