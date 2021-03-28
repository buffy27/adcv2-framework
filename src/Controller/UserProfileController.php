<?php

namespace App\Controller;

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
     * @Route("/user/profile", name="user_profile")
     */
    public function index(): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }

    /**
     * @Route("/avatar/{id}", requirements={"id"="\d+"})
     * @IsGranted ({"ROLE_ADMIN", "ROLE_USER"})
     */
    public function avatar($id){
        $user = $this->entityMangaer->getRepository(User::class)->find($id);
        $avatar = $this->getParameter('kernel.project_dir') . "/data/avatar/" . $user->getAvatar();
        $file = file_get_contents($avatar);
        return new Response($file, 200, ['Content-Type' => 'image/png']) ;
    }
}