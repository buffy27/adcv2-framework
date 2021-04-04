<?php

namespace App\Controller;

use App\Entity\Countries;
use App\Entity\User;
use App\Services\TrackerMemcached;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\ProfileSettingsFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserProfileController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    private TrackerMemcached $memcached;

    public function __construct(EntityManagerInterface $entityManager, TrackerMemcached $memcached)
    {
        $this->entityManager = $entityManager;
        $this->memcached = $memcached;
    }

    /**
     * @Route("/user/profile", name="user.profile")
     */
    public function profile(Request $request): Response
    {
        return $this->render('user_profile/index.html.twig', $this->memcached->getUserStats());
    }

    /**
     * @Route("/user/profile/{id}", name="user.profile.id", requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function user_profile($id): Response
    {
        if($id == $this->getUser()->getId()){
            return $this->render('user_profile/index.html.twig', $this->memcached->getUserStats());
        }

        $user = $this->entityManager->getRepository(User::class)->find($id);
        if(!empty($user)) {
            $country = $this->entityManager->getRepository(Countries::class)->find($user->getIdCountry());
            return $this->render('user_profile/user_profile.html.twig', [
                'user' => $user,
                'country' => $country,
                'class' => $user->getUserClass()
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
        $user = $this->entityManager->getRepository(User::class)->find($id);
        if(!empty($user)) {
            $country = $this->entityManager->getRepository(Countries::class)->find($user->getIdCountry());
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
        $countries = $this->entityManager->getRepository(Countries::class)->findAllNames();

        $userSettings = $this->createForm(ProfileSettingsFormType::class, [
            'countries' => $countries
        ]);

        return $this->render('user_profile/profile_settings.html.twig', array_merge($this->memcached->getUserStats(), ['userSettings' => $userSettings->createView()]));
    }

    /**
     * @Route("/user/tracker", name="user.tracker")
     */
    public function tracker_settings(): Response
    {
        return $this->render('user_profile/tracker_settings.html.twig', $this->memcached->getUserStats());
    }

    /**
     * @Route("/user/forum", name="user.forum")
     */
    public function forum_settings(): Response
    {
        return $this->render('user_profile/forum_settings.html.twig', $this->memcached->getUserStats());
    }

    /**
     * @Route("/user/security", name="user.security")
     */
    public function security_settings(): Response
    {
        return $this->render('user_profile/security_settings.html.twig', $this->memcached->getUserStats());
    }

    /**
     * @Route("/user/active", name="user.active")
     */
    public function active(): Response
    {
        return $this->render('user_profile/active.html.twig', $this->memcached->getUserStats());
    }

    /**
     * @Route("/avatar/{id}", requirements={"id"="\d+"}, name="avatar")
     * @param $id
     * @return Response
     */
    public function avatar($id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $avatar = $this->getParameter('kernel.project_dir') . "/data/avatar/" . $user->getAvatar();
        $file = file_get_contents($avatar);
        return new Response($file, 200, ['Content-Type' => 'image/png']) ;
    }
}