<?php

namespace App\Controller;

use App\Entity\PmBox;
use App\Entity\PmFolder;
use App\Entity\PmTo;
use App\Entity\User;
use App\Form\ForwardMessageFormType;
use App\Form\ReplyMessageFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\SendMessageFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Webmozart\Assert\Tests\StaticAnalysis\nullOrCount;

class MessagesController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/messages", name="messages")
     */
    public function index(Request $request): Response
    {
        $inbox = $this->entityManager->getRepository(PmTo::class)->findByReceiver([
            'receiver' => $this->getUser(),
            'folder' => $this->entityManager->getRepository(PmFolder::class)->findOneBy(['name'=>'Inbox'])
        ]);
        return $this->render('messages/index.html.twig', [
            'inbox' => $inbox,
        ]);
    }

    /**
     * @Route ("/messages/sentbox", name="messages.sentbox")
     */
    public function sentbox(){
        $sentbox = $this->entityManager->getRepository(PmTo::class)->findBy([
            'receiver' => $this->getUser(),
            'folder' => $this->entityManager->getRepository(PmFolder::class)->findOneBy(['name'=>'Sentbox'])
        ]);

        return $this->render('messages/sentbox.html.twig', [
            'sentbox' => $sentbox
        ]);
    }

    /**
     * @Route ("/message/{id}", name="message", requirements={"id"="\d+"})
     */
    public function message($id, Request $request){
        $message = $this->entityManager->getRepository(PmTo::class)->findOneBy([
            'message' => $id,
            'receiver' => $this->getUser(),
            'folder' => $this->entityManager->getRepository(PmFolder::class)->findBy(['name'=>'Inbox'])
        ]);
        if(empty($message)){
            $message = $this->entityManager->getRepository(PmTo::class)->findOneBy([
                'message' => $id,
                'receiver' => $this->getUser(),
                'sender' => $this->getUser(),
                'folder' => $this->entityManager->getRepository(PmFolder::class)->findBy(['name'=>'Sentbox'])
            ]);
            $sentbox = true;
        }
        if(empty($message)){
            return $this->render('errors/404.tracker.html.twig');
        }

        if($message->getPmRead() == false){
            $message->setPmRead(true);
            $this->entityManager->flush();
        }

        return $this->render('messages/message.html.twig',[
            'pmto' => $message,
            'sentbox' => $sentbox ?? null,
            'system' => $message->getSender() ?? null
        ]);
    }

    /**
     * @Route ("send_message/{id}", name="message.send", requirements={"id"="\d+"}, methods={"POST", "GET"})
     */
    public function send_message(int $id, Request $request){
        $user = $this->entityManager->getRepository(User::class)->findBy(['id'=>$id]);
        $form = $this->createForm(SendMessageFormType::class);
        if(!$user){
           return $this->render('errors/tracker_error.html.twig', [
               'error' => 'User doesn\'t exists'
            ]);
        }
        $user = $user[0];
        if($user->getPersonalSettings()['accept_pms'] != 'all'){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => 'User doesn\'t accept PMs'
            ]);
        }
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if(!$data['message']){
                $form->get('message')->addError(new FormError("Message can't be empty"));
            }else{
                $folder = $this->entityManager->getRepository(PmFolder::class);
                $pmbox = new PmBox();
                $pmbox->setMessage($data['message']);
                $pmbox->setSubject($data['subject']);
                $pmbox->setAdded();
                $this->entityManager->persist($pmbox);
                $this->entityManager->flush();
                if(in_array('save_sendbox', $this->getUser()->getPersonalSettings()['pm_details'])){
                    $pmto_sender = new PmTo();
                    $pmto_sender->setMessage($pmbox);
                    $pmto_sender->setSender($this->getUser());
                    $pmto_sender->setReceiver($this->getUser());
                    $pmto_sender->setFolder($folder->findOneBy(['name'=>'Sentbox']));
                    $pmto_sender->setPmRead(true);
                    $this->entityManager->persist($pmto_sender);
                }
                $pmto_receiver = new PmTo();
                $pmto_receiver->setSender($this->getUser());
                $pmto_receiver->setReceiver($user);
                $pmto_receiver->setMessage($pmbox);
                $pmto_receiver->setFolder($folder->findOneBy(['name'=>'Inbox']));
                $pmto_receiver->setPmRead(false);
                $this->entityManager->persist($pmto_receiver);
                $this->entityManager->flush();
            }
            $this->addFlash('message_sent', 'Your message was sent successfully');
            return new RedirectResponse($this->generateUrl('user.profile.id', ['id' =>$id]));
        }

        return $this->render('messages/send_message.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/remove_message/{id}", name="message.remove", requirements={"id":"\d+"})
     * @param $id
     * @return RedirectResponse|Response
     */
    public function remove_message($id){
        $message = $this->entityManager->getRepository(PmTo::class)->findOneBy([
            'message' => $id,
            'receiver' => $this->getUser(),
            'folder' => $this->entityManager->getRepository(PmFolder::class)->findBy(['name'=>'Inbox'])
        ]);

        if(empty($message)){
            $message = $this->entityManager->getRepository(PmTo::class)->findOneBy([
                'message' => $id,
                'receiver' => $this->getUser(),
                'sender' => $this->getUser(),
                'folder' => $this->entityManager->getRepository(PmFolder::class)->findBy(['name'=>'Sentbox'])
            ]);
        }
        if(empty($message)){
            return $this->render('errors/404.tracker.html.twig');
        }
        $folder = $message->getFolder();
        $this->entityManager->remove($message);
        $this->entityManager->flush();
        if($folder->getName() === "Inbox")
            return new RedirectResponse($this->generateUrl('messages'));
        else
            return new RedirectResponse($this->generateUrl('messages.sentbox'));
    }

    /**
     * @param $id
     * @Route ("/reply_message/{id}", name="message.reply", requirements={"id":"\d+"})
     */
    public function reply_message($id, Request $request){
        $message = $this->entityManager->getRepository(PmTo::class)->findOneBy([
            'message' => $id,
            'receiver' => $this->getUser(),
            'folder' => $this->entityManager->getRepository(PmFolder::class)->findBy(['name'=>'Inbox'])
        ]);

        if(empty($message)){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => "You can't replay to your own message"
            ]);
        }
        $folder = $this->entityManager->getRepository(PmFolder::class);
        $complsed_message = ">" . $message->getMessage()->getMessage() . "\n\n";
        $form = $this->createForm(ReplyMessageFormType::class, ['message' => $complsed_message]);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $reply = new PmBox();
            $reply->setMessage($form->get('message')->getData());
            $reply->setAdded();
            $reply->setSubject($message->getMessage()->getSubject());
            $this->entityManager->persist($reply);
            $this->entityManager->flush();

            $pmto_receiver = new PmTo();
            $pmto_receiver->setSender($this->getUser());
            $pmto_receiver->setReceiver($message->getSender());
            $pmto_receiver->setMessage($reply);
            $pmto_receiver->setFolder($folder->findOneBy(['name'=>'Inbox']));
            $pmto_receiver->setPmRead(false);
            $this->entityManager->persist($pmto_receiver);

            if(in_array('delete_after', $this->getUser()->getPersonalSettings()['pm_details'])){
                $this->entityManager->remove($message);
            }
            $this->entityManager->flush();

            return new RedirectResponse($this->generateUrl('message', ['id'=>$id]));
        }

        return $this->render('messages/reply_message.html.twig',[
            'pmto' => $message,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @Route ("/forward_message/{id}", name="message.forward", requirements={"id":"\d+"})
     */
    public function forward_message($id, Request $request){
        $message = $this->entityManager->getRepository(PmTo::class)->findOneBy([
            'message' => $id,
            'receiver' => $this->getUser(),
            'folder' => $this->entityManager->getRepository(PmFolder::class)->findBy(['name'=>'Inbox'])
        ]);

        if(empty($message)){
            return $this->render('errors/tracker_error.html.twig', [
                'error' => "You can't replay to your own message"
            ]);
        }

        $form = $this->createForm(ForwardMessageFormType::class, [
            'forwarded' => $message->getMessage()->getMessage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $data = $form->getData();
            if(is_numeric($data['receiver'])){
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['id'=>$data['receiver']]);
            }else{
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$data['receiver']]);
            }
            if(!$user){
                $form->get('receiver')->addError(new FormError('User not found'));
            }
            if($user == $message->getSender()){
                $form->get('receiver')->addError(new FormError('You can forward to the same user use replay instead'));
            }
            if($user == $this->getUser()) {
                $form->get('receiver')->addError(new FormError('You can forward to yourself'));
            }
            $folder = $this->entityManager->getRepository(PmFolder::class);

            $forwarded = new PmBox();
            $forwarded->setSubject($data['subject']);
            $forwarded->setMessage($data['message']);
            $forwarded->setAdded();
            $this->entityManager->persist($forwarded);
            $this->entityManager->flush();

            $pmto_receiver = new PmTo();
            $pmto_receiver->setSender($this->getUser());
            $pmto_receiver->setReceiver($user);
            $pmto_receiver->setMessage($forwarded);
            $pmto_receiver->setFolder($folder->findOneBy(['name'=>'Inbox']));
            $pmto_receiver->setPmRead(false);
            $this->entityManager->persist($pmto_receiver);
            $this->entityManager->flush();

            return new RedirectResponse($this->generateUrl('message', ['id'=>$id]));
        }

        return $this->render('messages/forward_message.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
