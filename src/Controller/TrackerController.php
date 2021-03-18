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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        dump($torrents);
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
    public function upload(Request $request): Response
    {
        if($request->getMethod() == "POST" && $request->get('preview')) {
           // $request->get('torrent_file')->getData();
            return $this->redirectToRoute('upload.preview', [
                'request' => $request
            ], 307);
        }

        $categories = $this->entityMangaer->getRepository(TorrentsCategory::class)->findAllNames();

        $form = $this->createForm(UploadFormType::class, ['categories' => $categories]);
        $form->handleRequest($request);

        dump($form->get('release_details')->setData("hello"));
        return $this->render('tracker/upload.html.twig', [
            'uploadForm' => $form->createView(),
            'user' => $this->getUser()
        ]);
    }
    /**
     * @Route ("/upload/preview", name="upload.preview")
     * @param Request $request
     * @return Response
     */
    public function preview(Request $request): Response
    {
        $upload_form = $request->request->get('upload_form');
        $form = $this->createForm(UploadPreviewFormType::class);
        $form->get('release_details')->setData($upload_form['release_details']);

       $torrentFile = new TorrentFile($request->files->get('upload_form')['torrent_file']);

        //dump($request->files->get('upload_form')['torrent_file']);
        return $this->render('tracker/upload_preview.html.twig', [
            'user' => $this->getUser(),
            'upload' => $upload_form,
            'previewForm' => $form->createView(),
            'torrent_file' => $request->files->get('upload_form')['torrent_file']
        ]);
    }

}
