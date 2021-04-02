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
        dump($this->getUser()->getAvatar());
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        //$country = $this->entityMangaer->getRepo
        return $this->render('user_profile/index.html.twig', [
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

    /**
     * @Route("/user/profile/{id}", name="user.profile.id", requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function user_profile($id): Response
    {
        //$country = $this->entityMangaer->getRepo
        if($id == $this->getUser()->getId()){
            $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
            return $this->render('user_profile/index.html.twig', [
                'user' => $this->getUser(),
                'country' => $country
            ]);
        }

        $user = $this->entityMangaer->getRepository(User::class)->find($id);
        if(!empty($user)) {
            $country = $this->entityMangaer->getRepository(Countries::class)->find($user->getIdCountry());
            return $this->render('user_profile/user_profile.html.twig', [
                'user' => $user,
                'country' => $country
            ]);
        }

        return $this->render('errors/tracker_error.html.twig', [
            'error' => "User not found!"
        ]);
    }

    /**
     * @Route ("/user/active/{id}", name="user.active.id", requirements={"id"="\d+"})
     */
    public function user_active($id){
        $user = $this->entityMangaer->getRepository(User::class)->find($id);
        if(!empty($user)) {
            $country = $this->entityMangaer->getRepository(Countries::class)->find($user->getIdCountry());
            return $this->render('user_profile/user_active.html.twig', [
                'user' => $user,
                'country' => $country
            ]);
        }

        return $this->render('errors/tracker_error.html.twig', [
            'error' => "User not found!"
        ]);
    }

    /**
     * @Route("/user/general", name="user.settings")
     */
    public function profile_settings(): Response
    {
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        return $this->render('user_profile/profile_settings.html.twig',[
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

    /**
     * @Route("/user/tracker", name="user.tracker")
     */
    public function tracker_settings(): Response
    {
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        return $this->render('user_profile/tracker_settings.html.twig',[
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

    /**
     * @Route("/user/forum", name="user.forum")
     */
    public function forum_settings(): Response
    {
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        return $this->render('user_profile/forum_settings.html.twig',[
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

    /**
     * @Route("/user/security", name="user.security")
     */
    public function security_settings(): Response
    {
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        return $this->render('user_profile/security_settings.html.twig',[
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

    /**
     * @Route("/user/active", name="user.active")
     */
    public function active(): Response
    {
        $country = $this->entityMangaer->getRepository(Countries::class)->find($this->getUser()->getIdCountry());
        return $this->render('user_profile/active.html.twig',[
            'user' => $this->getUser(),
            'country' => $country
        ]);
    }

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