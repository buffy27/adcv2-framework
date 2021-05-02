<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Entity\PmBox;
use App\Entity\PmFolder;
use App\Entity\PmTo;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/friends", name="friends")
     */
    public function index(): Response
    {
        $friends = $this->entityManager->getRepository(Friends::class)->findByUser($this->getUser());

        return $this->render('friends/index.html.twig', [
           'friends' => empty($friends) ? null : $friends,
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/add_friend/{id}", name="friend.add", requirements={"id":"\d+"})
     */
    public function add_friend($id){
        //TODO generate token id
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id'=>$id]);
        if(!$user){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => "User doesn't exist"
            ]);
        }
        $friends = $this->entityManager->getRepository(Friends::class)->findFriendRelation($this->getUser(), $user);
        if($friends){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => "You are already sent a friend request"
            ]);
        }

        $folder = $this->entityManager->getRepository(PmFolder::class)->findOneBy(['name'=>'Inbox']);
        $message = new PmBox();
        $message->setSubject("Friend request from " . $user->getUsername());
        $message->setMessage("<div class='col'><a class='no-decoration btn mr-2' href='" . $this->generateUrl('friend.request', ['choice' => 'accept', 'id' => $this->getUser()->getId()]) . "'>Accept</a><a class='no-decoration btn' href='" . $this->generateUrl('friend.request', ['choice' => 'decline', 'id' => $id]) . "'>Decline</a></div>");
        $message->setAdded();
        $this->entityManager->persist($message);
        $this->entityManager->flush();
        $send_request = new PmTo();
        $send_request->setMessage($message);
        $send_request->setPmRead(false);
        $send_request->setReceiver($user);
        $send_request->setFolder($folder);
        $send_request->setSender();
        $this->entityManager->persist($send_request);

        $friend = $this->entityManager->getRepository(Friends::class)->findOneBy([
            'user' => $this->getUser()
        ]);

        if(empty($friend)) {
            $friend = new Friends();
            $friend->setUser($this->getUser());
            $friend->setFriend($user);
            $this->entityManager->persist($friend);
        }
        $this->entityManager->flush();
        $this->addFlash('friend_request', 'Friend request has been sent');
        return new RedirectResponse($this->generateUrl('user.profile.id', ['id'=>$id]));
    }
    /**
     * @Route("/remove_friend/{id}", name="friend.remove", requirements={"id":"\d+"})
     */
    public function remove_friend($id, Request $request){
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id'=>$id]);
        $friend = $this->entityManager->getRepository(Friends::class)->findByUser($user);
        if(!$friend){
            return  $this->render('errors/tracker_error.html.twig', [
                'error' => 'You are not a friend with this user'
            ]);
        }
        $this->entityManager->remove($friend[0]);
        $this->entityManager->flush();

        if(str_contains($request->headers->get('referer'),$this->generateUrl('user.profile.id',['id'=>$id]))){
            return new RedirectResponse($this->generateUrl('user.profile.id',['id'=>$id]));
        }
        return new RedirectResponse($this->generateUrl('friends'));
    }
    /**
     * @Route("/friend_request/{choice}/{id}", name="friend.request", requirements={"id":"\d+", "choice":"^[A-Za-z]+$"})
     */
    public function friend_request($choice, $id, Request $request){
        if($choice != "accept" && $choice != "decline" ){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => 'Invalid request friend'
            ]);
        }
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id'=>$id]);
        if(empty($user)){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => 'User doens\'t exists'
            ]);
        }

        $friends = $this->entityManager->getRepository(Friends::class)->findOneBy([
            'user' => $user,
            'friend' => $this->getUser()
        ]);
        if($choice === "accept"){
            $friends->setStatus(true);
            $friends->setAdded(new \DateTime('now'));
            $this->entityManager->persist($friends);
            $this->entityManager->flush();
        }
        if($choice === "decline"){
            return new RedirectResponse($this->generateUrl('messages'));
        }

        return new RedirectResponse($this->generateUrl('friends'));
    }
}
