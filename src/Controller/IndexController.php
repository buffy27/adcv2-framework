<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Cache\CacheItemPoolInterface;

class IndexController extends AbstractController
{
    private $entityMangaer;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityMangaer = $entityManager;
    }

    /**
     * @Route("/", name="index")
     * @Route("/index", name="index.index")
     */
    public function index(): Response
    {
        $news = $this->entityMangaer->getRepository(News::class)->findAll();
        return $this->render('index/index.html.twig', [
            'news' => $news
        ]);
    }
    /**
     * @Route("/create_news", name="news.create")
     */
    public function createNews(Request $request): Response
    {
        dump($request->request->all());
        return $this->render('index/create_news.html.twig', [

        ]);
    }
    /**
     * @Route("/delete_news", name="news.delete")
     */
    public function deleteNews(){

    }

    /**
     * @Route ("/faq", name="faq")
     */
    public function faq(): Response
    {
        return $this->render('index/faq.html.twig', [

        ]);
    }

    /**
     * @Route ("/rules", name="rules")
     */
    public function rules(): Response
    {
        return $this->render('index/rules.html.twig', [

        ]);
    }

    /**
     * @Route ("/tos", name="tos")
     */
    public function tos(): Response
    {
        return $this->render('index/tos.html.twig', [

        ]);
    }

    /**
     * @Route ("/donation", name="donation")
     */
    public function donation(): Response
    {
        return $this->render('index/donation.html.twig', [

        ]);
    }
}
