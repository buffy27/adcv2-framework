<?php

namespace App\Controller;

use App\Entity\Torrents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function torrent($id): Response
    {
        $torrent = $this->entityMangaer->getRepository(Torrents::class)->find($id);
        dump($torrent);
        return $this->render('tracker/torrent.html.twig', [
            'torrent' => $torrent,
            'user' => $this->getUser()
        ]);
    }
}
