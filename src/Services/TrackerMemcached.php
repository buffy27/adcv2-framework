<?php


namespace App\Services;



use App\Entity\Countries;
use App\Entity\UserClass;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;
use Symfony\Component\Cache\Adapter\TraceableAdapter;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\Cache\Exception\CacheException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class TrackerMemcached
{
    private $cache;
    private $entityManager;
    private $security;
    private $user_cache;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        try {
            $client = MemcachedAdapter::createConnection(
                'memcached://localhost');
        } catch (\ErrorException $e) {}

        try {
            $this->cache = new MemcachedAdapter($client);
        } catch (CacheException $e) { }

        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->user_cache = [
            'id' => $security->getUser()->getId(),
            'username' => $security->getUser()->getUsername()
        ];

    }
    public function getUserStats()
    {
        $country = $this->entityManager->getRepository(Countries::class)->find($this->security->getUser()->getIdCountry());
        //$class = $this->entityManager->getRepository(UserClass::class)->find($this->security->getUser()->getRoles());
        return [
            'country' => $country,
            'user' => $this->security->getUser(),
            'class_name' => $this->security->getUser()->getUserClass()->getName()
        ];
    }
    public function setUserStats(){

    }
}