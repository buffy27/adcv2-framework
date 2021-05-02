<?php

namespace App\Controller;

use App\Entity\Countries;
use App\Entity\Friends;
use App\Entity\Invites;
use App\Entity\Peers;
use App\Entity\Snatched;
use App\Entity\SyncAnnounce;
use App\Entity\Torrents;
use App\Entity\User;
use App\Form\ActiveSearchFormType;
use App\Form\SendInviteFormType;
use App\Form\TrackerSettingsFormType;
use App\Services\TrackerMemcached;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\ProfileSettingsFormType;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use finfo;
use phpDocumentor\Reflection\Types\This;
use Rhilip\Bencode\Bencode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use ZipArchive;
use function Webmozart\Assert\Tests\StaticAnalysis\nullOrCount;


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
        return $this->render('user_profile/index.html.twig');
    }

    /**
     * @Route("/user/profile/{id}", name="user.profile.id", requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function user_profile($id): Response
    {
        if($id == $this->getUser()->getId()){
            return $this->render('user_profile/index.html.twig');
        }

        $user = $this->entityManager->getRepository(User::class)->find($id);
        if(!is_null($user->getIdTitle())){
            $title = [
                'name' => $user->getIdTitle()->getTitle(),
                'titlepic' => $user->getIdTitle()->getTitlepic()
            ];
        }
        $invited_by = $this->entityManager->getRepository(Invites::class)->findOneBy(['invitee' => $user]);

        if(!empty($user)) {
            $country = $this->entityManager->getRepository(Countries::class)->find($user->getIdCountry());

            $friends = $this->entityManager->getRepository(Friends::class)->findFriendRelation($this->getUser(), $user);
            dump($friends);
            return $this->render('user_profile/user_profile.html.twig', [
                'user' => $user,
                'country' => $country,
                'class' => $user->getUserClass(),
                'title' => isset($title) ? $title : null,
                'invited_by' => $invited_by ?? null,
                'friends' => $friends
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
        if(!is_null($user->getIdTitle())){
            $title = [
                'name' => $user->getIdTitle()->getTitle(),
                'titlepic' => $user->getIdTitle()->getTitlepic()
            ];
        }
        if(!empty($user)) {
            $country = $this->entityManager->getRepository(Countries::class)->find($user->getIdCountry());
            return $this->render('user_profile/user_active.html.twig', [
                'user' => $user,
                'country' => $country,
                'title' => isset($title) ? $title : null
            ]);
        }

        return $this->render('errors/tracker_error.html.twig', [
            'error' => "User not found!"
        ]);
    }

    /**
     * @Route("/user/general", name="user.settings")
     */
    public function profile_settings(Request $request): Response
    {
        $countries = $this->entityManager->getRepository(Countries::class)->findAllNames();
        $user = $this->getUser();

        $userSettings = $this->createForm(ProfileSettingsFormType::class, [
            'countries' => $countries,
            'personal_settings' => $user->getPersonalSettings(),
            'country' => $this->memcached->getUserStats()['country_id']
        ]);

        $userSettings->handleRequest($request);
        if($userSettings->isSubmitted() && $userSettings->isValid()){
            $formData = $userSettings->getData();

            $user->setIdCountry($this->entityManager->getRepository(Countries::class)->find($formData['id_country']));
            $user->setPersonalSettings([
                'account_parked' => $formData['parked'],
                'accept_pms' => $formData['accept_pms'],
                'pm_details' => $formData['pm_details'],
            ]);

            if($userSettings['avatar']->getData()){
                $ext = substr($userSettings['avatar']->getData()->getMimeType(), -3);
                file_put_contents($this->getParameter('kernel.project_dir') . "/data/avatar/" . $this->getUser()->getId() . "." . $ext, file_get_contents($userSettings['avatar']->getData()->getRealPath()));
                $user->setAvatar($this->getUser()->getId() . "." . $ext);
            }

            $this->entityManager->flush();
            unset($user);
            $this->memcached->removeUserStats();
            return new RedirectResponse($this->generateUrl('user.settings'));
        }
        unset($user);
        return $this->render('user_profile/profile_settings.html.twig',  ['userSettings' => $userSettings->createView()]);
    }

    /**
     * @Route("/user/tracker", name="user.tracker")
     */
    public function tracker_settings(Request $request): Response
    {
        $user = $this->getUser();

        $trackerSettings = $this->createForm(TrackerSettingsFormType::class, [
            'tracker_settings' => $user->getTrackerSettings()
        ]);

        $trackerSettings->handleRequest($request);
        if($trackerSettings->isSubmitted()){
            $formData = $trackerSettings->getData();

            $user->setTrackerSettings([
                'torrents_page' => $formData['torrents_page'],
                'comments_torrent_page' => $formData['comments_torrent_page'],
                'torrent_details' => $formData['torrent_details'],
            ]);
            $this->entityManager->flush();

            return new RedirectResponse($this->generateUrl('user.tracker'));
        }
        return $this->render('user_profile/tracker_settings.html.twig', array_merge($this->memcached->getUserStats(), [
            'trackerSettings' => $trackerSettings->createView()
        ]));
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
     * @Route ("/user/send_invite", name="user.send_invite")
     */
    public function send_invite(Request $request, MailerInterface $mailer): Response
    {
        if(!$this->getUser()->getUserInvites()){
            return $this->render('errors/tracker_error.html.twig',[
                'error' => "You don't have any invites."
            ]);
        }
        $sendInvite = $this->createForm(SendInviteFormType::class);

        $sendInvite->handleRequest($request);
        if($sendInvite->isSubmitted() && $sendInvite->isValid()){
            if($sendInvite->get('email')->getData() == $this->getUser()->getEmail()){
                return $this->render('errors/tracker_error.html.twig',[
                    'error' => "You can't have multiple accounts"
                ]);
            }
            if(!empty($this->entityManager->getRepository(User::class)->getUserByEmail($sendInvite->get('email')->getData()))){
                return $this->render('errors/tracker_error.html.twig',[
                    'error' => "User already exists!"
                ]);
            }
            $gen_inv = hash('SHA3-256', hash("SHA3-256", random_bytes(20)));
            $invite = new Invites();
            $invite->setEmail($sendInvite->get('email')->getData());
            $invite->setAdded();
            $invite->setStatus('pending');
            $invite->setInvite($gen_inv);
            $invite->setExpires(date_create('+1 day'));
            $invite->setInviter($this->getUser());
            $invite->setInvitee();
            $this->entityManager->persist($invite);
            $email = (new TemplatedEmail())->from(new Address('system@rainandcoffee.com', 'System'))
                ->to($sendInvite->get('email')->getData())
                ->subject("Register your ADC account")
                ->htmlTemplate("security/invite.html.twig");

            $context = $email->getContext();
            $context['inviter'] = $this->getUser()->getUsername();
            $context['invite_url'] = $request->getSchemeAndHttpHost() ."/signup/" . $gen_inv;
            $email->context($context);
            $mailer->send($email);
            $this->getUser()->setUserInvites($this->getUser()->getUserInvites()-1);
            $this->entityManager->flush();
            $this->memcached->removeUserStats();
        }

        return $this->render('user_profile/send_invite.html.twig', array_merge($this->memcached->getUserStats(), [
            'sendInvite' => $sendInvite->createView()
        ]));
    }

    /**
     * @Route("/user/active", name="user.active", methods={"GET"})
     */
    public function active(SessionInterface $session, Request $request): Response
    {
        if($request->query->get('reset') || strpos($request->headers->get('referer'), $this->generateUrl('user.active')) === false){
            $session->remove('active');
        }

        if(!$session->has('active')) {
            $query =  $request->query->all();
            $query['active_toggle'] = 'my_uploads';
            $session->set('active', $query);
        }elseif($session->has('active') && isset($request->query->all()['active_search_form'])){
            $session->set('active', $request->query->all()['active_search_form']);
            $query = $session->get('active');
        }else{
            $query = $session->get('active');
        }

        if(!$query || $query['active_toggle'] == 'my_uploads'){
            /** @var QueryBuilder $data */
            $my_uploads = $this->entityManager->getRepository(Torrents::class)->createQueryBuilder('t')
            ->where('t.owner = :user')
            ->setParameter('user', $this->getUser());
        }
        if(isset($query['active_toggle']) && $query['active_toggle'] == 'seeding'){
            $data = $this->entityManager->getRepository(Peers::class)->createQueryBuilder('ps')
                ->select('t as torrent, ps.toGo, ps.downloaded, ps.uploaded')
                ->join(Torrents::class, 't', Join::WITH, 'ps.torrent = t')
                ->where('ps.user = :user')
                ->andWhere('ps.toGo = 0')
                ->setParameter('user', $this->getUser()->getId());
        }
        if(isset($query['active_toggle']) && $query['active_toggle'] == 'leeching'){
            $data = $this->entityManager->getRepository(Peers::class)->createQueryBuilder('ps')
                ->select('t as torrent, ps.toGo, ps.downloaded, ps.uploaded')
                ->join(Torrents::class, 't', Join::WITH, 'ps.torrent = t')
                ->where('ps.user = :user')
                ->andWhere('ps.toGo > 0')
                ->setParameter('user', $this->getUser()->getId());
        }
        if(isset($query['active_toggle']) && $query['active_toggle'] == 'completed'){
            $data = $this->entityManager->getRepository(Snatched::class)->createQueryBuilder('ps')
                ->select('t as torrent, ps.toGo, ps.downloaded, ps.uploaded')
                ->join(Torrents::class, 't', Join::WITH, 'ps.torrent = t')
                ->where('ps.user = :user')
                ->andWhere('ps.toGo = 0')
                ->setParameter('user', $this->getUser()->getId());
        }
        if(isset($query['active_toggle']) && $query['active_toggle'] == 'incomplete'){
            $data = $this->entityManager->getRepository(Snatched::class)->createQueryBuilder('ps')
                ->select('t as torrent, ps.toGo, ps.downloaded, ps.uploaded')
                ->join(Torrents::class, 't', Join::WITH, 'ps.torrent = t')
                ->where('ps.user = :user')
                ->andWhere('ps.toGo > 0')
                ->setParameter('user', $this->getUser()->getId());
        }
        if(!empty($query['search_text']) && isset($my_uploads)){
            $search = explode(' ', $query['search_text']);
            for ($i = 0; $i < count($search); $i++) {
                $my_uploads->andWhere(' LOWER(t.name) LIKE LOWER(CONCAT(\'%\', :word_' . $i . ',\'%\'))');
                $my_uploads->setParameter('word_' . $i, $search[$i]);
            }
        }

        if(!empty($query['search_text']) && !isset($my_uploads)){
            $search = explode(' ', $query['search_text']);
            for ($i = 0; $i < count($search); $i++) {
                $data->andWhere(' LOWER(t.name) LIKE LOWER(CONCAT(\'%\', :word_' . $i . ',\'%\'))');
                $data->setParameter('word_' . $i, $search[$i]);
            }
        }

        $data = isset($data) ? $data->getQuery()->getResult() : null;
        $my_uploads = isset($my_uploads) ? $my_uploads->getQuery()->getResult() : null;

        if($request->query->get('dl_torrents') && (isset($data) || isset($my_uploads))){
            $filesystem = new Filesystem();

            $active = $data ?? $my_uploads;
            $file = $filesystem->tempnam("/tmp", "zip");
            $zip = new ZipArchive();
            $zip->open($file, ZipArchive::OVERWRITE);
            foreach ($active as $value){
                $temp = (isset($my_uploads) ? $value : $value['torrent']);
                $sync_announce = $this->entityManager->getRepository(SyncAnnounce::class)->getSyncAnnounce($this->getUser(), $temp);

                if(!$sync_announce) {
                    $data_passkey = hash("SHA3-512", $this->getUser()->getSecret() . random_bytes(8) . $this->getUser()->getPasskey() . random_bytes(16));
                    $sync = new SyncAnnounce();
                    $sync->setUser($this->getUser());
                    $sync->setTorrent($temp);
                    $sync->setDataPasskey($data_passkey);
                    $sync->setAdded();
                    $this->entityManager->persist($sync);
                    $this->entityManager->flush();
                }else{
                    $data_passkey = $sync_announce[0]->getDataPasskey();
                }

                $path = $this->getParameter("kernel.project_dir") . "/data/torrents/" . $value->getInfoHash(). ".torrent";
                $torrentFile = Bencode::load($path);
                $torrentFile['announce'] = $request->getSchemeAndHttpHost() .  "/announce/" . $data_passkey;
                $zip->addFromString($temp->getName() . ".torrent", Bencode::encode($torrentFile));
            }
            $zip->close();
            $headers = [
                'Content-Type' => 'application/zip',
                'Content-Description' => 'File Transfer',
                'Pragma' => 'public',
                'Content-Length' => filesize($file),
                'Content-Disposition' => 'attachment; filename="torrents.zip"',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            ];
            return new Response(file_get_contents($file),200, $headers);
        }


        $searchForm = $this->createForm(ActiveSearchFormType::class, $query);
        return $this->render('user_profile/active.html.twig', [
            'peers' => $data,
            'my_uploads' => $my_uploads,
            'searchForm' => $searchForm->createView(),
            'active' => $session->get('active')
        ]);
    }

    /**
     * @Route("/avatar/{id}", requirements={"id"="\d+"}, name="avatar")
     * @param $id
     * @return Response
     */
    public function avatar($id): Response
    {
        if($this->getUser()->getId() != $id)
            $user = $this->entityManager->getRepository(User::class)->find($id);
        else
            $user = $this->getUser();
        $avatar = $this->getParameter('kernel.project_dir') . "/data/avatar/" . $user->getAvatar();
        unset($user);
        $file = file_get_contents($avatar);

        return new Response($file, 200, ['Content-Type' => mime_content_type($avatar)]) ;
    }
}