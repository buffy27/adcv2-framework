<?php


namespace App\Services;

use App\Entity\Invites;
use App\Entity\Peers;
use App\Entity\Torrents;
use App\Entity\User;
use App\Libraries\AnnounceFunctions;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

use \Datetime;
use function Webmozart\Assert\Tests\StaticAnalysis\throws;

class TrackerMemcached
{
    private $entityManager;
    private $security;
    private $trackerCache;
    private $announce;

    public function __construct(EntityManagerInterface $entityManager, Security $security, CacheInterface $trackerCache, AnnounceFunctions $announce)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->trackerCache = $trackerCache;
        $this->announce = $announce;
    }
    public function getUserStats() : array
    {
        $this->removeUserStats();
        try {
            return $this->trackerCache->get(md5($this->security->getUser()->getUsername()), function (ItemInterface $item) {
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
                    'tracker_settings' => $user->getTrackerSettings()
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
        $this->trackerCache->delete('trackerStatus');
        return $this->trackerCache->get('trackerStatus', function (ItemInterface $item){
           $item->expiresAt(date_create('+15 minutes'));

           $active_accounts = $this->entityManager->getRepository(User::class)->findAll();
           $torrents = $this->entityManager->getRepository(Torrents::class)->findAll();
           $peers = $this->entityManager->getRepository(Peers::class)->getAllPeersCount();

           return [
               'active_accounts' => count($active_accounts),
               'torrents' => count($torrents),
               'peers' => $peers //TODO S/L is wrong in twig
           ];
        });
    }
    public function getPeer(){
        return $this->entityManager->getRepository(Peers::class)->getPeersCountByUser($this->security->getUser());
    }
    public function cleanPeers(){
        //TODO check this to a no-return type
        return $this->trackerCache->get('peersCleanUp', function (ItemInterface $item) {
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
}