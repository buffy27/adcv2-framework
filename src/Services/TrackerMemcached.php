<?php


namespace App\Services;

use App\Entity\Invites;
use App\Entity\Peers;
use App\Entity\PmTo;
use App\Entity\Torrents;
use App\Entity\User;
use App\Libraries\CacheInterface;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;
use Symfony\Component\Security\Core\Security;

use \Datetime;
use Symfony\Contracts\Cache\ItemInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\throws;

class TrackerMemcached
{
    private $entityManager;
    private $security;
    private $cachePool;
    private $cacheUtil;
    private $functions;

    public function __construct(EntityManagerInterface $entityManager, Security $security,  MemcachedAdapter $cachePool, CacheInterface $cacheUtil, Functions $functions)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->cachePool = $cachePool;
        $this->cacheUtil = $cacheUtil;
        $this->functions = $functions;
    }
    public function getUserStats()
    {
        dump($this->cacheUtil->getItem($this->cachePool, md5($this->security->getUser()->getUsername())));
        if($this->cacheUtil->getItem($this->cachePool, md5($this->security->getUser()->getUsername()))){
            return $this->cacheUtil->getItem($this->cachePool, md5($this->security->getUser()->getUsername()));
        }else{
            $user = $this->security->getUser();
            $invited_by = $this->entityManager->getRepository(Invites::class)->findOneBy(['invitee' => $this->security->getUser()]);

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
                'invites' => $user->getUserInvites(),
                'tracker_settings' => $user->getTrackerSettings(),
                'personal_settings' => $user->getPersonalSettings(),
                'forum_settings' => $user->getForumSettings()
            ];
            if(!is_null($user->getIdTitle())){
                $stats['title'] =  [
                    'name' => $user->getIdTitle()->getTitle(),
                    'titlepic' => $user->getIdTitle()->getTitlepic()
                ];
            }
            if(!empty($invited_by)){
                $stats['invitedby']['username'] = $invited_by->getInviter()->getUserName();
                $stats['invitedby']['id'] = $invited_by->getInviter()->getId();
            }else{
                $stats['invitedby'] = null;
            }

            $this->cacheUtil->saveItem($this->cachePool, md5($this->security->getUser()->getUsername()), $stats, $this->functions->date_to_seconds(date_create('+30 minute')));
            return $stats;
        }
    }
    public function removeUserStats(){
        //$this->trackerCache->delete(md5($this->security->getUser()->getUsername()));
    }
    public function getInboxMessages(){
        return [
            'inbox' => count($this->entityManager->getRepository(PmTo::class)->findBy([
                'receiver' => $this->security->getUser(),
                'folder' => 1
            ])),
            'new' => count($this->entityManager->getRepository(PmTo::class)->findBy([
                'receiver' => $this->security->getUser(),
                'PmRead' => 0,
                'folder' => 1
            ]))
        ];
    }
    public function getTrackerStatus() : array {
        if($this->cacheUtil->getItem($this->cachePool, 'trackerStatus')){
            return $this->cacheUtil->getItem($this->cachePool, 'trackerStatus');
        }else{
            $active_accounts = $this->entityManager->getRepository(User::class)->findAll();
            $torrents = $this->entityManager->getRepository(Torrents::class)->findAll();
            $peers = $this->entityManager->getRepository(Peers::class)->getAllPeersCount();

            $status =  [
                'active_accounts' => count($active_accounts),
                'torrents' => count($torrents),
                'peers' => $peers //TODO S/L is wrong in twig
            ];
            $this->cacheUtil->saveItem($this->cachePool, 'trackerStatus', $status, $this->functions->date_to_seconds(date_create("+15 minutes")));
            return $status;
        }
    }
    public function getPeer(){
        return $this->entityManager->getRepository(Peers::class)->getPeersCountByUser($this->security->getUser());
    }
    public function cleanPeers(){
        //TODO check this to a no-return type
        $this->trackerCache->delete("peersCleanUp");
        $this->trackerCache->get('peersCleanUp', function (ItemInterface $item) {
            $item->expiresAt(date_create('+6 hours'));
            /** @var Peers $peers */
            $peers = $this->entityManager->getRepository(Peers::class)->findAll();
            foreach ($peers as $peer) {
                $interval  = date_diff($peer->getLastAction(), new \DateTime('now'));
                if ($interval->h > 0) {
                    $this->entityManager->remove($peer);
                }
            }
            $this->entityManager->flush();
            return date_create('now');
        });
    }
    public function setAntiFloodAnnounce(){
        $this->cacheUtil->saveItem($this->cachePool, 'zz', 'new');
    }
}