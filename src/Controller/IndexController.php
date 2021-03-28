<?php

namespace App\Controller;

use App\Entity\Countries;
use App\Entity\News;
use App\Entity\UserClass;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @Security ("is_granted('ROLE_ADMIN')")
     * @Route("/create_news", name="news.create")
     */
    public function createNews(Request $request): Response
    {
        if($request->getMethod() == "POST") {
            $new = new News();
            $new->setAdded();
            $new->setAddedBy($this->getUser());
            $new->setText($request->get('text_area'));
            $new->setTitle($request->get('title'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($new);
            $em->flush();
            return new RedirectResponse($this->generateUrl('index'));
        }
        return $this->render('index/create_news.html.twig', [
        ]);
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/delete_news/{id}", name="news.delete")
     */
    public function deleteNews($id, Request $request){
        $news = $this->entityMangaer->getRepository(News::class)->find($id);
        $this->entityMangaer->remove($news);
        $this->entityMangaer->flush();
        return new RedirectResponse($this->generateUrl('index'));
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
