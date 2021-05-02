<?php

namespace App\EventListeners;

use App\Entity\Tracker;
use App\Services\TrackerMemcached;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\Security\Core\Security;

class RequestListener
{
    private EntityManagerInterface $entityManager;
    private ContainerInterface $container;
    private Security $security;
    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->security = $security;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $tracker_status = $this->entityManager->getRepository(Tracker::class)->find(1);

        if (!$event->isMasterRequest()) {
            return;
        }
        if ($request->attributes->get('_route') === '_wdt') {
            return;
        }
        $user = $this->security->getUser();
        if(!is_null($user)) {
            $user->setLastAction(new \DateTime('now'));
            $this->entityManager->flush();
        }

        if($request->attributes->get('_route') == "app_register" && !$tracker_status->getGlobalSignup()) {
            if($this->security->getUser())
                return;
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
        $response->setMaxAge(0);
        $response->headers->addCacheControlDirective('must-revalidate');
        $response->headers->addCacheControlDirective('no-store');
        $response->headers->addCacheControlDirective('no-cache');
    }
}