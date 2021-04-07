<?php


namespace App\Services;

use App\Entity\Invites;
use App\Entity\Peers;
use App\Entity\Torrents;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

use \Datetime;

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
    public function getUserStats() : array
    {
        try {
            return $this->trackerCache->get(md5($this->security->getUser()->getUsername()), function (ItemInterface $item) {
                $user = $this->security->getUser();
                $invited_by = $this->entityManager->getRepository(Invites::class)->findOneBy(['inviter' => $this->security->getUser()]);
                $stats = [
                    'downloaded' => $user->getDownloaded(),
                    'uploaded' => $user->getUploaded(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                    'id' => $user->getId(),
                    'added' => $user->getAdded(),
                    'ip' => $user->getIp(),
                    'flagpic' => $user->getIdCountry()->getFlagpic(),
                    'country' => $user->getIdCountry()->getName(),
                    'country_id' => $user->getIdCountry()->getId(),
                    'class' => $user->getUserClass(),
                    'last_action' => $user->getLastAction(),
                    'invites' => $user->getUserInvites()
                ];
                if(!is_null($user->getIdTitle())){
                    $stats['title'] =  [
                        'name' => $user->getIdTitle()->getTitle(),
                        'titlepic' => $user->getIdTitle()->getTitlepic()
                    ];
                }
                $item->expiresAt(date_create('+30 minute'));
                return $stats;
            });
        } catch (InvalidArgumentException $e) {
            return ['error' => $e];
        }
    }
    public function removeUserStats(){
        $this->trackerCache->delete(md5($this->security->getUser()->getUsername()));
    }
    public function getTrackerStatus() : array {
        return $this->trackerCache->get('trackerStatus', function (ItemInterface $item){
           $item->expiresAt(date_create('+15 minutes'));
           $active_accounts = $this->entityManager->getRepository(User::class)->findAll();
           $torrents = $this->entityManager->getRepository(Torrents::class)->findAll();
           $peers = $this->entityManager->getRepository(Peers::class)->findAll();
           return [
               'active_accounts' => count($active_accounts),
               'torrents' => count($torrents),
               'peers' => count($peers)
           ];
        });
    }
    public function getPeer(){
        return $this->entityManager->getRepository(Peers::class)->getPeersCountByUser($this->security->getUser());
    }
    public function cleanPeers(){
        //TODO check this to a no-return type
        return $this->trackerCache->get('peersCleanUp', function (ItemInterface $item) {
            $item->expiresAt(date_create('+12 hours'));
            /** @var Peers $peers */
            $peers = $this->entityManager->getRepository(Peers::class)->findAll();
            foreach ($peers as $peer) {
                $interval  = date_diff($peer->getLastAction(), new \DateTime('now'));
                dump($interval);
                if ($interval->h > 0) {
                    $this->entityManager->remove($peer);
                }
            }
            $this->entityManager->flush();
            return date_create('now');
        });
    }
}