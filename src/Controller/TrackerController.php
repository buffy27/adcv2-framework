<?php

namespace App\Controller;

use App\Entity\Bookmarks;
use App\Entity\Peers;
use App\Entity\SyncAnnounce;
use App\Entity\TorrentComments;
use App\Entity\Torrents;
use App\Entity\TorrentsCategory;
use App\Form\EditCommentFormType;
use App\Form\EditTorrentFormType;
use App\Form\UploadFormType;
use App\Libraries\AnnounceFunctions;
use App\Libraries\TorrentFile;
use App\Services\TrackerMemcached;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Rhilip\Bencode\Bencode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use function Twig\Extra\Markdown\twig_html_to_markdown;
use function Webmozart\Assert\Tests\StaticAnalysis\fileExists;
use function Webmozart\Assert\Tests\StaticAnalysis\nullOrIsEmpty;

class TrackerController extends AbstractController
{
    private $entityManager;
    private $announce;

    public function __construct(EntityManagerInterface $entityManager, AnnounceFunctions $announce)
    {
        $this->entityManager = $entityManager;
        $this->announce = $announce;
    }

    /**
     * @Route("/torrents/{page}", name="torrents", methods={"GET"}, requirements={"page"="\d+"}, defaults={"page"=1} )
     */
    public function torrents(int $page = 1, Request $request, SessionInterface $session, TrackerMemcached $memcached): Response
    {
        $expr = $this->entityManager->getExpressionBuilder();
        /** @var QueryBuilder $torrents */
        $torrents = $this->entityManager->getRepository(Torrents::class)->createQueryBuilder('t');
        $torrents->select('t')
                 ->addSelect('(SELECT COUNT(s) FROM App\Entity\Snatched as s WHERE s.torrent = t) as sn')
            ->addSelect('(SELECT COUNT(tc) FROM App\Entity\TorrentComments as tc WHERE tc.torrents = t) as tcm');

        if($request->query->get('search')){
            $session->set('search', $request->query->all());
        }
        if($request->query->get('reset')){
            $session->remove('search');
        }

        if(isset($session->get('search')['searchbox']) && !empty($session->get('search')['searchbox'] && !isset($session->get('search')['search_desc']))){
            $search = explode(' ', $session->get('search')['searchbox']);
            for ($i = 0; $i < count($search); $i++) {
                $torrents->andWhere(' LOWER(t.name) LIKE LOWER(CONCAT(\'%\', :word_' . $i . ',\'%\'))');
                $torrents->setParameter('word_' . $i, $search[$i]);
            }
        }

        if(isset($session->get('search')['searchbox']) && !empty($session->get('search')['searchbox'] && isset($session->get('search')['search_desc']))){
            $search = explode(' ', $session->get('search')['searchbox']);
            for ($i = 0; $i < count($search); $i++) {
                $torrents->andWhere(' LOWER(t.name) LIKE LOWER(CONCAT(\'%\', :word_' . $i . ',\'%\')) OR LOWER(t.description) LIKE LOWER(CONCAT(\'%\', :word_desc_' . $i . ',\'%\')) OR LOWER(t.contentInfo) LIKE LOWER(CONCAT(\'%\', :word_content_' . $i . ',\'%\'))');
                $torrents->setParameter('word_' . $i, $search[$i]);
                $torrents->setParameter('word_desc_' . $i, $search[$i]);
                $torrents->setParameter('word_content_' . $i, $search[$i]);
            }
        }
        //comact this
        if(isset($session->get('search')['golden']) && isset($session->get('search')['silver'])){
            $torrents->andWhere('t.bonus = \'freeleech\' OR t.bonus = \'silver\'');
        }else {
            if (isset($session->get('search')['golden'])) {
                $torrents->andWhere('t.bonus = \'freeleech\'');
            }

            if (isset($session->get('search')['silver'])) {
                $torrents->andWhere('t.bonus = \'silver\'');
            }
        }

        if(isset($session->get('search')['my_uploads'])){
            $torrents->andWhere('t.owner = :user');
            $torrents->setParameter('user', $this->getUser());
        }
        if(isset($session->get('search')['categories'])){
            $categories = $request->query->get('categories');
            $sql = "";
            for ($i = 0; $i < count($categories); $i++) {
                if(isset($session->get('search')['search_desc'])){
                    $sql .= $i == 0 ? 't.tCategory = :cat_' . $i : ' OR t.tCategory = :cat_' . $i;
                }else {
                    $torrents->orWhere('t.tCategory = :cat_' . $i);
                    $torrents->setParameter('cat_' . $i, $categories[$i]);
                }
            }
            if(!empty($sql)){
                $torrents->andWhere($sql);
                for ($i = 0; $i < count($categories); $i++) {
                    $torrents->setParameter('cat_' . $i, $categories[$i]);
                }
            }
        }

        $expr = $this->entityManager->getExpressionBuilder();
        // AND opperator between search box and the left boxes
        if(isset($session->get('search')['search_desc'])){
            $sql = "";
            if(isset($session->get('search')['dvd'])){
                $sql .= 'JSON_EXTRACT(t.specs, \'$.format\') = \'dvd\'';
            }
            if(isset($session->get('search')['bdmv'])){
                $sql .= ' OR JSON_EXTRACT(t.specs, \'$.format\') = \'bdmv\'';
            }
            if(isset($session->get('search')['uhd'])){
                $sql .= ' OR JSON_EXTRACT(t.specs, \'$.format\') = \'uhd\'';
            }
            if(!empty($sql))
            $torrents->andWhere($sql);
        }else{
            if(isset($session->get('search')['dvd'])){
                $torrents->orWhere('JSON_EXTRACT(t.specs, \'$.format\') = \'dvd\'');
            }
            if(isset($session->get('search')['bdmv'])){
                $torrents->orWhere('JSON_EXTRACT(t.specs, \'$.format\') = \'bdmv\'');
            }
            if(isset($session->get('search')['uhd'])){
                $torrents->orWhere('JSON_EXTRACT(t.specs, \'$.format\') = \'uhd\'');
            }
        }
        $torrents->groupBy('t');
        $torrents->orderBy('t.added', 'DESC');
        $paginator = new Paginator($torrents);
        $totalItems = count($paginator);
        $curentPage = ($page) ?: 1;
        $totalPageCount = (int)ceil($totalItems / $memcached->getUserStats()['tracker_settings']['torrents_page']);
        $nextPage = (($curentPage < $totalPageCount) ? $curentPage + 1 : $totalPageCount);
        $previousPage = (($curentPage > 1) ? $curentPage - 1 : 1);

        $torrents = $paginator->getQuery()
            ->setFirstResult($memcached->getUserStats()['tracker_settings']['torrents_page'] * ($curentPage-1))
            ->setMaxResults($memcached->getUserStats()['tracker_settings']['torrents_page'] )
            ->getResult();

        return $this->render('tracker/torrents.html.twig', [
            'torrents' => $torrents,
            'search_session' => $session->get('search'),
            'next_page' => $nextPage,
            'previous_page' => $previousPage,
            'total_pages' => $totalPageCount,
            'current_page' => $curentPage
        ]);
    }

    /**
     * @Route("/torrent/{id}", name="torrent", requirements={"id"="\d+"})
     */
    public function torrent($id, Request $request): Response
    {
        $torrent = $this->entityManager->getRepository(Torrents::class)->find($id);
        if(!$torrent)
            return $this->render("errors/tracker_error.html.twig", ['error' => "Torrent with id " . $id . " was not found in database"]);
        $comments = $this->entityManager->getRepository(TorrentComments::class)->findByTorrentId($torrent);
        $peers = $this->entityManager->getRepository(Peers::class)->findByTorrent($torrent->getId());


        if($request->getMethod() == "POST"){
            $comment = new TorrentComments();
            $comment->setComment($request->get('comment_desc'));
            $comment->setAdded(new \DateTime("now"));
            $comment->setTorrents($torrent);
            $comment->setUser($this->getUser());
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
            return new RedirectResponse($this->generateUrl('torrent', ['id' => $id]));
        }

        $is_bookmark = $this->entityManager->getRepository(Bookmarks::class)->findOneBy([
            'user' => $this->getUser(),
            'torrent' => $torrent
        ]);

        return $this->render('tracker/torrent.html.twig', [
            'torrent' => $torrent,
            'torrent_details' => array_flip($this->getUser()->getTrackerSettings()['torrent_details']),
            'comments' => $comments,
            'peers' => $peers,
            'is_bookmarked' => $is_bookmark
        ]);
    }

    /**
     * @param $id
     * @Route ("/torrent/remove/{id}", name="torrent.remove", requirements={"id"="\d+"}, methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function torrent_remove($id): Response
    {
        $torrent = $this->entityManager->getRepository(Torrents::class)->find($id);

        if(!$torrent)
            return $this->render("errors/tracker_error.html.twig", ['error' => "Torrent with id " . $id . " was not found in database"]);

        unlink($this->getParameter("kernel.project_dir") . "/data/torrents/" . $torrent->getInfoHash(). ".torrent");
        unlink($this->getParameter("kernel.project_dir") . "/data/torrent_posters/" . $id . $torrent->getContentPoster());
        $this->entityManager->remove($torrent);
        $this->entityManager->flush();
        return $this->render("tracker/info.html.twig", ["info" => "Torrent has been removed"]);
    }

    /**
     * @param $id
     * @Route ("/torrent/edit/{id}", name="torrent.edit", requirements={"id"="\d+"}, methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_TORRENT_MODERATOR') or is_granted('ROLE_MODERATOR') or is_granted('ROLE_SENIOR_MODERATOR')")
     */
    public function torrent_edit($id){
        $torrent = $this->entityManager->getRepository(Torrents::class)->findOneBy(['id'=>$id]);

        $form = $this->createForm(EditTorrentFormType::class, $torrent);

        return $this->render('tracker/edit_torrent.html.twig', [
            'torrent' => $torrent,
            'edit_form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/comment/edit/{id}", name="comment.edit", requirements={"id"="\d+"}, methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_TORRENT_MODERATOR') or is_granted('ROLE_MODERATOR') or is_granted('ROLE_SENIOR_MODERATOR')")
     */
    public function edit_torrent_comment($id, Request $request){
        /** @var TorrentComments $comment */
        $comment = $this->entityManager->getRepository(TorrentComments::class)->findOneBy([
            'id' => $id
        ]);
        $form = $this->createForm(EditCommentFormType::class, [
            'comment' => $comment->getComment()
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $comment->setComment($form->get('comment')->getData());
            $comment->setEditedAt();
            $this->entityManager->flush();
            return new RedirectResponse($this->generateUrl('torrent', [
                'id' => $comment->getTorrents()->getId()
            ]) . "#comment-" . $id);
        }

        return $this->render('tracker/edit_comment.html.twig', [
            'edit_comment' => $form->createView()
        ]);
    }

    /**
     * @Route ("/comment/remove/{id}", name="comment.remove", requirements={"id"="\d+"}, methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_TORRENT_MODERATOR') or is_granted('ROLE_MODERATOR') or is_granted('ROLE_SENIOR_MODERATOR')")
     */
    public function remove_torrent_comment($id){
        $comment = $this->entityManager->getRepository(TorrentComments::class)->findOneBy([
            'id' => $id
        ]);
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
        return new RedirectResponse($this->generateUrl('torrent', [
                'id' => $comment->getTorrents()->getId()
            ]));
    }

    /**
     * @param $id
     * @Route ("/torrent/download/{id}", name="torrent.download", requirements={"id"="\d+"})
     */
    public function torrent_download($id, Request $request){
        $torrent = $this->entityManager->getRepository(Torrents::class)->find($id);
        if(!$torrent)
            return $this->render("errors/tracker_error.html.twig", ['error' => "Torrent with id " . $id . " was not found in database"]);
        $sync_announce = $this->entityManager->getRepository(SyncAnnounce::class)->getSyncAnnounce($this->getUser(), $torrent);
        if(!$sync_announce) {
            $data_passkey = hash("SHA3-512", $this->getUser()->getSecret() . random_bytes(8) . $this->getUser()->getPasskey() . random_bytes(16));
            $sync = new SyncAnnounce();
            $sync->setUser($this->getUser());
            $sync->setTorrent($torrent);
            $sync->setDataPasskey($data_passkey);
            $sync->setAdded();
            $this->entityManager->persist($sync);
            $this->entityManager->flush();
        }else{
            $data_passkey = $sync_announce[0]->getDataPasskey();
        }
        /*
        $error = isset($this->announce->addUser($data_passkey, $this->getUser()->getId())['error']) ? $this->announce->addUser($data_passkey, $this->getUser()->getId())['error'] : null;

        if(isset($error)){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => $error
            ]);
        }*/
        $path = $this->getParameter("kernel.project_dir") . "/data/torrents/" . $torrent->getInfoHash(). ".torrent";
        $torrentFile = Bencode::load($path);
        $torrentFile['announce'] = $request->getSchemeAndHttpHost() .  "/announce/" .$data_passkey;

        $headers = [
            'Content-Type' => 'application/x-bittorrent; charset=UTF-8',
            'Content-Description' => 'File Transfer',
            'Pragma' => 'public',
            'Content-Disposition' => 'attachment; filename="' . $torrent->getName() . '.torrent"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        ];
        $file = Bencode::encode($torrentFile);

        return new Response($file,200, $headers);
    }

    /**
     * @Route ("/upload", name="upload", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request): Response
    {
        $uploader = $this->getUser();
        $categories = $this->entityManager->getRepository(TorrentsCategory::class)->findAllNames();
        $form = $this->createForm(UploadFormType::class, ['categories' => $categories]);
        $form->handleRequest($request);

        $torrentData = [];
        $upload_form = $request->request->get('upload_form');

        if(!empty($request->files->get('upload_form')['torrent_file'])) {
            $torrentFile = new TorrentFile($request->files->get('upload_form')['torrent_file']);
            if (!isset($upload_form['torrent_name']) && $torrentFile->getTorrentFile())
                $torrentData['name'] = $torrentFile->getTorrentFile()['info']['name'];
            else
                $torrentData['name'] = $upload_form['torrent_name'];

            if ($torrentFile->getTorrentFile()) {
                $torrentData['size'] = $torrentFile->getTorrentSize();
                $torrentData['files'] = $torrentFile->getTorrentFiles();
            }
        }
        if($request->getMethod() == "POST" && isset($_POST['preview'])){
            if(isset($torrentData['size']))
                $torrentData['size'] = $this->getSize($torrentData['size']);
            else {
                $torrentData['size'] = "---";
                $torrentData['files']['total'] = "---";
                $torrentData['files']['info_hash'] = "---";
                $torrentData['name'] = "---";
            }
            return new JsonResponse($torrentData);
        }

        if($form->isSubmitted() && $form->isValid()){
            $torrent_file = new TorrentFile($form->get('torrent_file')->getData());
            $formData = $form->getData();
            $checkFile = $this->getParameter('kernel.project_dir') . "/data/torrents/" . $torrent_file->getTorrentFiles()['info_hash'] . ".torrent";
            if(file_exists($checkFile)){
                $form->get('torrent_file')->addError(new FormError("Torrent already exists in database"));
            }elseif ($torrent_file->getTorrentFile()['announce'] != $request->getSchemeAndHttpHost() . "/announce") {
                dump($torrent_file->getTorrentFile()['announce']);
                dump($request->getSchemeAndHttpHost() . "/announce");
                $form->get('torrent_file')->addError(new FormError("Wrong announce"));
            }else{
                $category = $this->entityManager->getRepository(TorrentsCategory::class)->find($formData['tCategory']);
                $torrent = new Torrents();
                $torrent->setOwner($uploader);
                $torrent->setInfoHash($torrent_file->getTorrentFiles()['info_hash']);
                $torrent->setTCategory($category);
                $torrent->setAdded();
                $torrent->setSeeders();
                $torrent->setLeechers();
                $torrent->setSize($torrent_file->getTorrentSize());
                $torrent->setBonus();
                $torrent->setSnatched(0);
                $torrent->setLastAction();
                $torrent->setSpecs([
                    "type" => $category->getName(),
                    "format" => $request->get('template_radio')
                ]);
                $torrent->setDescription($formData['release_details']);
                $torrent->setContentInfo($formData['content_info']);
                if(isset($formData['torrent_name']))
                    $torrent->setName($formData['torrent_name']);
                else
                    $torrent->setName($torrent_file->getTorrentFile()['info']['name']);
                $torrent->setContentPoster(substr($formData['content_poster'], -4));
                if(isset($formData['mediainfo']))
                    $torrent->setMediaInfo($formData['mediainfo']);
                $torrent->setContentUrl($formData['content_url']);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($torrent);
                $entityManager->flush();
                $torrentFile->makeTorrentFile($this->getParameter('kernel.project_dir'));

                file_put_contents($this->getParameter('kernel.project_dir') . "/data/torrent_posters/" . $torrent->getId() . $torrent->getContentPoster()  , file_get_contents($formData['content_poster']));
                unset($formData);
                return new RedirectResponse($this->generateUrl('torrent', ['id' => $torrent->getId()]));
            }
        }
        return $this->render('tracker/upload.html.twig', [
            'uploadForm' => $form->createView(),
            'user' => $uploader,
            'announce' => $request->getSchemeAndHttpHost() . "/announce",
        ]);
    }

    /**
     * @Route("/torrent/poster/{id}", name="torrent.poster", requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function torrent_poster($id): Response
    {
        $torrent = $this->entityManager->getRepository(Torrents::class)->findOneBy(['id'=>$id]);
        if(!$torrent)
            return $this->render('errors/tracker_error.html.twig', [
                'error' => 'Poster doesn\'t exist'
            ]);
        $poster = $this->getParameter('kernel.project_dir') . "/data/torrent_posters/" . $id . $torrent->getContentPoster();
        unset($torrent);
        $file = file_get_contents($poster);

        return new Response($file, 200, ['Content-Type' => mime_content_type($poster)]) ;
    }

    private function getSize($size){
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
