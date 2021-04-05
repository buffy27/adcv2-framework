<?php


namespace App\Services;



use App\Entity\Countries;
use App\Entity\Peers;
use App\Entity\UserClass;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;
use Symfony\Component\Cache\Adapter\TraceableAdapter;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\Cache\Exception\CacheException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class TrackerMemcached
{
    private $entityManager;
    private $security;
    private $trackerCache;

    public function __construct(EntityManagerInterface $entityManager, Security $security, CacheInterface $trackerCache)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->trackerCache = $trackerCache;
    }
    public function getUserStats()
    {
        try {
            return $this->trackerCache->get(md5($this->security->getUser()->getUsername()), function (ItemInterface $item) {
                $user = $this->security->getUser();
                $item->expiresAfter(date_create('+30 minute'));
                return [
                    'downloaded' => $user->getDownloaded(),
                    'uploaded' => $user->getUploaded(),
                ];
            });
        } catch (InvalidArgumentException $e) {
            return $e;
        }
    }
    public function getPeer(){
        return $this->entityManager->getRepository(Peers::class)->getPeersCountByUser($this->security->getUser());
    }
}