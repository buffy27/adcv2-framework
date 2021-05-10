<?php

namespace App\Controller;


use App\Entity\Logs;
use App\Entity\Peers;
use App\Entity\Snatched;
use App\Entity\SyncAnnounce;
use App\Exceptions\TrackerException;
use App\Services\Functions;
use App\Services\TrackerMemcached;
use Doctrine\ORM\EntityManagerInterface;
use HttpResponseException;
use Rhilip\Bencode\Bencode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AnnounceController extends AbstractController
{
    private $headers = [
        'Content-Type' => 'text/plain; charset=utf-8',
        'Pragma' => 'no-cache'
    ];

    private $entityManager;
    private $memcached;
    private $functions;

    public function __construct(EntityManagerInterface $entityManager, TrackerMemcached $memcached, Functions $functions)
    {
        $this->entityManager = $entityManager;
        $this->memcached = $memcached;
        $this->functions = $functions;
    }
    private function logTrackerException(\Exception $exception, Request $request){
        return new Response(Bencode::encode(['failure reason'=>'Anti cheat ']), 200, $this->headers);
    }
    /**
     * @Route("/announce/{passkey}", name="announce", methods={"GET"}, requirements={"passkey"="^[a-z0-9]{128,128}$"})
     * @throws HttpResponseException
     */
    public function announce($passkey, Request $request) : Response
    {
        $agent = $request->server->get('HTTP_USER_AGENT');
        $allHeaders = $request->server->getHeaders();
        if (preg_match("/^Mozilla/", $agent) || preg_match("/^Opera/", $agent) || preg_match("/^Links/", $agent) || preg_match("/^Lynx/", $agent) )
            return $this->render('errors/access_error.html.twig', [
                "error" => "Browser access blocked!"
            ]);
        if ($allHeaders){
            if($request->server->get('HTTPS') != "on")
            {
                if (isset($allHeaders["Cookie"]) || isset($allHeaders["Accept-Language"]) || isset($allHeaders["Accept-Charset"]))
                    return new Response(Bencode::encode(['failure reason'=>'Anti cheat ']), 200, $this->headers);
            }
        }

        try{
            $sync = $this->entityManager->getRepository(SyncAnnounce::class)->findByDataPasskey($passkey)[0];
            if(empty($sync))
                throw new TrackerException(140);
            if(empty($sync->getTorrent()))
                throw new TrackerException(152);

            $queries = $this->getAnnounceData($passkey, $request);


            $rep_dic = $this->generateAnnounceResponse($queries, $torrent);
        }catch (\Throwable $e){
            if ($e instanceof TrackerException && $e->getCode() >= 124)
                // Record agent deny log in Table `agent_deny_log`
                $rep_dic = $this->generateTrackerFailResponseDict($e);
        } finally {
            return new Response($rep_dic);
        }

        /**
         * When a torrent is removed it won't remove the peers from the sync_announce table
         * this is because the peers needs to be informed that torrent was removed in the client.
         */

        $self = $this->entityManager->getRepository(Peers::class)->findByAnnounce($sync->getUser(), $sync->getTorrent(), $queries['peer_id']);

        $torrent = $sync->getTorrent();
        $user = $sync->getUser();
        /** @var Snatched $snatched */
        $snatched = $this->entityManager->getRepository(Snatched::class)->findBy([
            'user' => $user,
            'torrent' => $torrent
        ]);
        if($snatched)
            $snatched = $snatched[0];

        $trueUploaded = $trueDownloaded = 0;
        $thisUploaded = $thisDownloaded = 0;

        if(!$self && $queries['event'] != "stopped") {
            $trueUploaded = max(0, $queries['uploaded']);
            $trueDownloaded = max(0, $queries['downloaded']);

            $sockres = @pfsockopen($queries['ip'], $queries['port'], $errno, $errstr, 5);
            if (!$sockres) {
                $connectable = "no";
            } else {
                $connectable = "yes";
                @fclose($sockres);
            }
            $peer = new Peers();
            $peer->setTorrent($sync->getTorrent())->setUser($sync->getUser())->setUploaded($trueUploaded)->setDownloaded($trueDownloaded)->setToGo($queries['left'])
                ->setIp($queries['ip'])->setPort($queries['port'])->setPeerId($queries['peer_id'])->setAgent($queries['user-agent'])
                ->setStarted()->setLastAction()->setSeeder($queries['seeder'])->setConnectable($connectable);
            $this->entityManager->persist($peer);

            if($queries['seeder'])
                $torrent->setSeeders($torrent->getSeeders() + 1);
            else
                $torrent->setLeechers($torrent->getLeechers() + 1);

            if(!$snatched){
                $snatched = new Snatched();
                $snatched->setTorrent($torrent);
                $snatched->setUser($user);
                $snatched->setDownloaded($trueDownloaded);
                $snatched->setUploaded($trueUploaded);
                $snatched->setIp($queries['ip']);
                $snatched->setPort($queries['port']);
                $snatched->setLastAction();
                $snatched->setCompletedat();
                $snatched->setStartdat();
                $snatched->setSeedtime(0);
                $snatched->setLeechtime(0);
                $snatched->setToGo($queries['left']);
                $this->entityManager->persist($snatched);
            }
        }else{
            $thisUploaded = $trueUploaded = max(0, $queries['uploaded'] - $self->getUploaded());
            $thisDownloaded = $trueDownloaded = max(0, $queries['downloaded'] - $self->getDownloaded());

            $this->calculateTorrentBonus($torrent, $user, $trueUploaded, $trueDownloaded, $thisUploaded, $thisDownloaded);

            if($queries['event'] === "stopped"){
                $this->entityManager->remove($self);
                if($queries['seeder'])
                    $torrent->setSeeders($torrent->getSeeders() - 1);
                else
                    $torrent->setLeechers($torrent->getLeechers() - 1);
            }else{
                $self->setUploaded($self->getUploaded() + $trueUploaded)
                     ->setDownloaded($self->getDownloaded() + $trueDownloaded)
                     ->setToGo($queries['left'])
                     ->setIp($queries['ip'])
                     ->setPort($queries['port'])
                     ->setSeeder($queries['seeder'])
                     ->setLastAction(new \DateTime('now'));
                $snatched->setUploaded($snatched->getUploaded() + $trueUploaded);
                $snatched->setDownloaded($snatched->getDownloaded() + $trueDownloaded);
                $snatched->setToGo($queries['left']);

                if($queries['left'] == 0)
                    $snatched->setSeedtime($snatched->getSeedtime() + $this->functions->date_to_seconds($snatched->getLastAction()));
                else
                    $snatched->setLeechtime($snatched->getLeechtime() + $this->functions->date_to_seconds($snatched->getLastAction()));

                $snatched->setLastAction();
            }
        }

        if($queries['event'] === "completed"){
            $torrent->setSeeders($torrent->getSeeders() + 1);
            $torrent->setLeechers($torrent->getLeechers() - 1);
            $snatched->setCompletedat();
        }

        $user->setUploaded($user->getUploaded() + $thisUploaded);
        $user->setDownloaded($user->getDownloaded() + $thisDownloaded);

        $this->memcached->cleanPeers();

        $this->entityManager->flush();
        $calc_peers = $this->entityManager->getRepository(Peers::class)->getPeersCountByTorrent($torrent);

        if($torrent->getSeeders() != $calc_peers['seeders']){
            $torrent->setSeeders($calc_peers['seeders']);
        }
        if($torrent->getSeeders() != $calc_peers['leechers']){
            $torrent->setLeechers($calc_peers['leechers']);
        }

        $this->entityManager->flush();
        return new Response($this->generateAnnounceResponse($queries, $torrent), 200, $this->headers);
    }

    private function getAnnounceData($passkey, Request $request){
        $queries = [
            'timestamp' => $request->server->get('REQUEST_TIME_FLOAT')
        ];

        foreach (['info_hash', 'peer_id', 'port', 'uploaded', 'downloaded', 'left'] as $value) {
            $item_data = $request->query->get($value);
            if (!is_null($item_data)) {
                $queries[$value] = $item_data;
            } else {
               throw new TrackerException(130, [':attribute' => $value]);
            }
        }
        foreach (['info_hash', 'peer_id'] as $value){
            if(strlen($queries[$value]) != 20){
                throw new TrackerException(132, [':attribute' => $value, ':rule' => 1]);
            }
        }
        foreach (['downloaded', 'uploaded', 'left', 'port'] as $value){
            if(!is_numeric($queries[$value]) || $queries[$value] < 0)
                throw new TrackerException(134, [':attribute' => $value]);
        }

        foreach ([
                     'event' => '', 'no_peer_id' => 1, 'compact' => 0,
                     'numwant' => 75, 'corrupt' => 0, 'key' => '',
                 ] as $key => $value) {
            $queries[$key] = $request->query->get($key, $value);
        }

        foreach (['numwant', 'corrupt', 'no_peer_id', 'compact'] as $value) {
            if (!is_numeric($queries[$value]) || $queries[$value] < 0) {
                throw new TrackerException(134, [':attribute' => $value]);
            }
        }
        if (!in_array(strtolower($queries['event']), ['started', 'completed', 'stopped', 'paused', ''])) {
            throw new TrackerException(136, [':event' => $queries['event']]);
        }
        if ($queries['port'] == 0 && strtolower($queries['event']) != 'stopped') {
            throw new TrackerException(137, [':event' => $queries['event']]);
        }
        if (!is_numeric($queries['port']) || $queries['port'] < 0 || $queries['port'] < 6881 || $queries['port'] > 0xffff || in_array($queries['port'], self::BLACK_PORTS)) {
            throw new TrackerException(135, [':port' => $queries['port']]);
        }
        //Request::setTrustedProxies(['127.0.0.1', 'REMOTE_ADDR'],Request::HEADER_X_FORWARDED_HOST);
        $queries['ip'] = $request->server->get('REMOTE_ADDR');
        $queries['user-agent'] = $request->headers->get('user-agent');
        $queries['seeder'] = $queries['left'] == 0;

        return $queries;
    }

    private function isReAnnounce($queries, Request $request)
    {
        $query_string = urldecode($request->getQueryString());
        $identity = md5(str_replace($queries['key'], '', $query_string));

        $prev_lock_expire_at = container()->get('redis')->zScore(Constant::trackerAnnounceLockZset, $identity) ?: $queries['timestamp'];
        if ($queries['timestamp'] >= $prev_lock_expire_at) {  // this identity is not lock
            container()->get('redis')->zAdd(Constant::trackerAnnounceLockZset, $queries['timestamp'] + 30, $identity);
            return false;
        }

        return true;
    }

    private function generateAnnounceResponse($queries, $torrent): string
    {
        $rep_dict = [
            'interval' => (int)(900 + rand(5, 20)),
            'min interval' => (int)(300 + rand(1, 10)),
            'complete' => $torrent->getSeeders(),
            'incomplete' =>  $torrent->getLeechers(),
            'peers' => ''
        ];

        $peers = $this->entityManager->getRepository(Peers::class)->getAllPeers($queries, $torrent);

        foreach ($peers as $peer){
            if($queries['compact']){
                $peer_insert_field = filter_var($peer->getIp(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? "peers6" : "peers";
                $rep_dict[$peer_insert_field] .= inet_pton($peer->getIp()) . pack('n', $peer->getPort());
            }
        }
        return Bencode::encode($rep_dict);
    }

    protected function generateTrackerFailResponseDict(\Throwable $exception)
    {
        if ($exception instanceof TrackerException) {
            $reason = $exception->getMessage();
        } else {
            $reason = 'Internal Error';
        }

        return Bencode::encode([
            'failure reason' => $reason,
            'min interval' => 5
        ]);
    }


    /**
     * @param $torrent
     * @param $user
     * @param $trueUploaded
     * @param $trueDownloaded
     * @param $thisUploaded
     * @param $thisDownloaded
     */
    private function calculateTorrentBonus($torrent, $user, $trueUploaded, $trueDownloaded, &$thisUploaded, &$thisDownloaded){
        $now = new \DateTime('now');

        if($torrent->getOwner() === $user) {
            $thisUploaded = $trueUploaded;
            $thisDownloaded = 0;
        }elseif($torrent->getBonus() === "freeleech" && $torrent->getBonusExpire() > $now) {
            $thisUploaded = $trueUploaded;
            $thisDownloaded = 0;
        }elseif ($torrent->getSpecs()['format'] === "dvd" && $torrent->getBonus() === "silver") {
            $thisUploaded = $trueUploaded;
            $thisDownloaded = (int)(0.5 * $trueDownloaded);
        }elseif ($torrent->getSpecs()['format'] === "bdmv" && $torrent->getBonus() === "silver") {
            $thisUploaded = $trueUploaded;
            $thisDownloaded = (int)(0.25 * $trueDownloaded);
        }elseif ($torrent->getSpecs()['format'] === "bdmv"){
            $thisUploaded = $trueUploaded;
            $thisDownloaded = (int)(0.5 * $trueDownloaded);
        }else{
            $thisUploaded = $trueUploaded;
            $thisDownloaded = $trueDownloaded;
        }
    }

    private function log_announce($log){
        $logs = new Logs();
        $logs->setLog($log);
        $logs->setAdded();
        $this->entityManager->persist($logs);
    }

    private const BLACK_PORTS = [
        22,  // SSH Port
        53,  // DNS queries
        80, 81, 8080, 8081,  // Hyper Text Transfer Protocol (HTTP) - port used for web traffic
        411, 412, 413,  // 	Direct Connect Hub (unofficial)
        443, 8443,  // HTTPS / SSL - encrypted web traffic, also used for VPN tunnels over HTTPS.
        1214,  // Kazaa - peer-to-peer file sharing, some known vulnerabilities, and at least one worm (Benjamin) targeting it.
        3389,  // IANA registered for Microsoft WBT Server, used for Windows Remote Desktop and Remote Assistance connections
        4662,  // eDonkey 2000 P2P file sharing service. http://www.edonkey2000.com/
        6346, 6347,  // Gnutella (FrostWire, Limewire, Shareaza, etc.), BearShare file sharing app
        6699,  // Port used by p2p software, such as WinMX, Napster.
        6881, 6882, 6883, 6884, 6885, 6886, 6887, 6888, 6889, 6890 // BitTorrent part of full range of ports used most often (unofficial)
        //65000, 65001, 65002, 65003, 65004, 65005, 65006, 65007, 65008, 65009, 65010   // For unknown Reason 2333~
    ];

    /**
     * @throws TrackerException
     */
    private function testCatch(){
        throw new TrackerException(160, [':count' => 15]);
    }
}
