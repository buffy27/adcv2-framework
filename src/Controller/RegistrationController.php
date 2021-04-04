<?php

namespace App\Controller;

use App\Entity\Countries;
use App\Entity\Language;
use App\Entity\User;
use App\Entity\UserClass;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use App\Security\AppLoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private $emailVerifier;

    private $entityManager;

    public function __construct(EmailVerifier $emailVerifier,EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/signup", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppLoginAuthenticator $authenticator): Response
    {
        $user = new User();
        $countries = $this->entityManager->getRepository(Countries::class)->findAllNames();


        $form = $this->createForm(RegistrationFormType::class, [
            'user' => $user,
            'countries' => $countries
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $secret = $this->mksecret();
            $data = $form->getData();

            if(!empty($this->entityManager->getRepository(User::class)->getUserByUsername($data['username']))){
                $form->get('username')->addError(new FormError("Username already exists in database"));
                return $this->render('security/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            if(!empty($this->entityManager->getRepository(User::class)->getUserByEmail($data['email']))){
                $form->get('email')->addError(new FormError("Invalid email address"));
                return $this->render('security/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            $user->setUsername($data['username']);
            $user->setSecret($secret);
            $user->setPassword(
                hash("sha3-256",  $secret . $form->get('password')->getData() .  $secret . $form->get('username')->getData() . $secret)
            );
            $country = $this->entityManager->getRepository(Countries::class)->find($data['id_country']);
            $language = $this->entityManager->getRepository(Language::class)->find(6);
            $userClass = $this->entityManager->getRepository(UserClass::class)->findOneBy(['name' => 'User']);
            $user->setIdCountry($country);
            $user->setGender($data['gender']);
            $user->setEmail($data['email']);
            $user->setBirthday($data['birthday']);
            $user->setIp($request->getClientIp());
            $user->setTrackerSettings([
                "show_desc" => "on",
                "show_content" => "on",
                "show_mediainfo" => "on",
                "show_nfo" => "on",
                "torrents_page" => 50,
                "comments_torrent_page" => 15
            ]);
            $user->setForumSettings([
                "topics_per_page" => 3,
                "posts_per_page" => 10,
                "signature" => "",
            ]);
            $user->setPersonalSettings([
                'account_parked' => false,
                'accept_pms' => "all",
                'pm_details' => [],
            ]);
            $user->setAvatar('default.png');
            $user->setPasskey(hash("sha3-256", $this->mksecret(25) . $form->get('password')->getData() . $this->mksecret(28)));
            $user->setIdLanguage($language);
            $user->setDownloaded(0);
            $user->setUploaded(0);
            $user->setInvitedBy(1);
            $user->setBanned(false);
            $user->setAdded();
            $user->setRole($userClass);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('system@rainandcoffee.com', 'System'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('security/confirmation_email.html.twig')
            );

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/signup/{invite}", name="app_register.invite")
     */
    public function registerInvite($invite, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppLoginAuthenticator $authenticator){
        return new RedirectResponse($this->generateUrl('app_login'));
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $id = $request->get('id'); // retrieve the user id from the url

        // Verify the user id exists and is not null
        if (null === $id) {
            return $this->redirectToRoute('app_login');
        }

       $user = $userRepository->find($id);

       // Ensure the user exists in persistence
       if (null === $user) {
           return $this->redirectToRoute('app_login');
       }
        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        return $this->redirectToRoute('app_login');
    }

    private function mksecret($len = 20)
    {
        $ret = "";
        for ($i = 0; $i < $len; $i++)
            $ret .= chr(random_int(33, 126));
        return $ret;
    }
}
