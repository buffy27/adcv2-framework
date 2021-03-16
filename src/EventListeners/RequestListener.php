<?php

namespace App\EventListeners;

use App\Entity\Tracker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RequestListener
{
    private EntityManagerInterface $eventManager;
    private ContainerInterface $container;

    public function __construct(EntityManagerInterface $eventManager, ContainerInterface $container)
    {
        $this->eventManager = $eventManager;
        $this->container = $container;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $tracker_status = $this->eventManager->getRepository(Tracker::class)->find(1);

        if (!$event->isMasterRequest()) {
            return;
        }
        if ($request->attributes->get('_route') === '_wdt') {
            return;
        }
        //Check if the tracker has closed the signup form
        //TODO check this route
       if($request->attributes->get('_route') == "app_register" && !$tracker_status->getGlobalSignup()) {
           $html = $this->container->get('twig')->render('security/closed_signup.html.twig', []);
           $event->setResponse(new Response($html));
       }
    }

    public function onKernelResponse(ResponseEvent $event){
        $request = $event->getRequest();
        if (!$request->isXmlHttpRequest()) {
            return;
        }

        $response = $event->getResponse();
        //dump($response);
    }
}