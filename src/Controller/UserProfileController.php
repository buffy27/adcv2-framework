<?php

namespace App\Controller;

use App\Entity\Countries;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserProfileController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityMangaer;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityMangaer = $entityManager;
    }

    /**
     * @Route("/user/profile", name="user.profile")
     */
    public function profile(): Response
    {
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        //$country = $this->entityMangaer->getRepo
        return $this->render('user_profile/index.html.twig', [
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

    /**
     * @Route("/user/profile/{id}", name="user.profile.id")
     */
    public function index($id): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }

    /**
     * @Route("/user/general", name="user.settings")
     */
    public function profile_settings(){}

    /**
     * @Route("/user/tracker", name="user.tracker")
     */
    public function tracker_settings(){}

    /**
     * @Route("/user/forum", name="user.forum")
     */
    public function forum_settings(){}

    /**
     * @Route("/user/security", name="user.security")
     */
    public function security_settings(){}

    /**
     * @Route("/avatar/{id}", requirements={"id"="\d+"}, name="avatar")
     * @param $id
     * @return Response
     */
    public function avatar($id): Response
    {
        $user = $this->entityMangaer->getRepository(User::class)->find($id);
        $avatar = $this->getParameter('kernel.project_dir') . "/data/avatar/" . $user->getAvatar();
        $file = file_get_contents($avatar);
        return new Response($file, 200, ['Content-Type' => 'image/png']) ;
    }
}