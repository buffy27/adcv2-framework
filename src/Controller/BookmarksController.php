<?php


namespace App\Controller;

use App\Entity\Bookmarks;
use App\Entity\Torrents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookmarksController
 * @package App\Controller
 *
 */
class BookmarksController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route ("/bookmarks/", name="bookmarks")
     */
    public function bookmarks(){
        return $this->render('bookmarks/bookmarks.html.twig', [
            'bookmarks' => $this->getUser()->getBookmarks()
        ]);
    }

    /**
     * @Route ("/bookmarks/add/{id}", name="bookmark.add", requirements={"id"="\d+"})
     */
    public function add_bookmark($id){
        $torrent = $this->entityManager->getRepository(Torrents::class)->findOneBy(['id'=>$id]);
        if(!$torrent){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => "Torrent was removed"
            ]);
        }
        $bookmark = new Bookmarks();
        $bookmark->setUser($this->getUser());
        $bookmark->setTorrent($torrent);
        $this->entityManager->persist($bookmark);
        $this->entityManager->flush();
        unset($torrent);
        unset($bookmark);
        return new RedirectResponse($this->generateUrl('torrent', ['id'=>$id]));
    }

    /**
     * @Route ("/bookmarks/remove/{id}", name="bookmark.remove", requirements={"id"="\d+"})
     */
    public function remove_bookmark($id){
        $torrent = $this->entityManager->getRepository(Torrents::class)->findOneBy(['id'=>$id]);
        $bookmark = $this->entityManager->getRepository(Bookmarks::class)->findOneBy([
            'user' => $this->getUser(),
            'torrent' => $torrent
        ]);
        if(!$bookmark){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => "You don't have this torrent in your bookmark"
            ]);
        }
        $this->entityManager->remove($bookmark);
        $this->entityManager->flush();
        return new RedirectResponse($this->generateUrl('torrent', ['id'=>$id]));
    }
}