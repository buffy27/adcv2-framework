<?php

namespace App\Controller;


use App\Entity\Logs;
use App\Entity\Peers;
use App\Entity\Snatched;
use App\Entity\SyncAnnounce;
use App\Services\Functions;
use App\Services\TrackerMemcached;
use Doctrine\ORM\EntityManagerInterface;
use Exception\TrackerException;
use http\Exception\BadMessageException;
use Rhilip\Bencode\Bencode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class AnnounceController extends AbstractController
{
    private $headers = [
        'Content-Type' => 'text/plain; charset=utf-8',
        'Pragma' => 'no-cache'
    ];

    private $entityMangaer;
    private $memcached;
    private $functions;

    public function __construct(EntityManagerInterface $entityManager, TrackerMemcached $memcached, Functions $functions)
    {
        $this->entityMangaer = $entityManager;
        $this->memcached = $memcached;
        $this->functions = $functions;
    }

    /**
     * @Route("/announce/{passkey}", name="announce", methods={"GET"}, requirements={"passkey"="^[a-z0-9]{128,128}$"})
     * @throws TrackerException
     */
    public function announce($passkey, Request $request) : Response
    {
        /**
         * When a torrent is removed it won't remove the peers from the sync_announce table
         * this is because the peers needs to be informed that torrent was removed in the client.
         */

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
        $queries = [
            'timestamp' => $request->server->get('REQUEST_TIME_FLOAT')
        ];

        $sync = $this->entityMangaer->getRepository(SyncAnnounce::class)->findByDataPasskey($passkey)[0];

        if(empty($sync)){
            return new Response($this->error(103), 200, $this->headers);
        }
        if(empty($sync->getTorrent())){
            return new Response($this->error(106), 200, $this->headers);
        }
        foreach (['info_hash', 'peer_id', 'port', 'uploaded', 'downloaded', 'left'] as $value) {
            $item_data = $request->query->get($value);
            if (!is_null($item_data)) {
                $queries[$value] = $item_data;
            } else {
                return new Response(Bencode::encode(['failure reason'=>'Client provided null data']), 200, $this->headers);
            }
        }
        foreach (['info_hash', 'peer_id'] as $value){
            if(strlen($queries[$value]) != 20){
                return new Response($this->error(100, [":attr" => $value]), 200, $this->headers);
            }
        }
        foreach (['downloaded', 'uploaded', 'left', 'port'] as $value){
            if(!is_numeric($queries[$value]) || $queries[$value] < 0)
                return new Response($this->error(101, [":attr" => $value]),200, $this->headers);
        }

        foreach ([
                     'event' => '', 'no_peer_id' => 1, 'compact' => 0,
                     'numwant' => 75, 'corrupt' => 0, 'key' => '',
                 ] as $key => $value) {
            $queries[$key] = $request->query->get($key, $value);
        }

        foreach (['numwant', 'corrupt', 'no_peer_id', 'compact'] as $item) {
            if (!is_numeric($queries[$item]) || $queries[$item] < 0) {
                return new Response($this->error(101, [":attr" => $value]), 200, $this->headers);
            }
        }
        if (!in_array(strtolower($queries['event']), ['started', 'completed', 'stopped', 'paused', ''])) {
            return new Response($this->error(101, [":event" => strtolower($queries['event'])]), 200, $this->headers);
        }
        if ($queries['port'] == 0 && strtolower($queries['event']) != 'stopped') {
            return new Response($this->error(105, [":event" => strtolower($queries['event'])]), 200, $this->headers);
        }
        if (!is_numeric($queries['port']) || $queries['port'] < 0 || $queries['port'] < 6881 || $queries['port'] > 0xffff || in_array($queries['port'], self::BLACK_PORTS)) {
            return new Response($this->error(104, [":port" => $queries['port']]), 200, $this->headers);
        }
        //TODO Recheck proxies
        //Request::setTrustedProxies(['127.0.0.1', 'REMOTE_ADDR'],Request::HEADER_X_FORWARDED_HOST);
        $queries['ip'] = $request->server->get('REMOTE_ADDR');//$request->getClientIp();
        $queries['user-agent'] = $request->headers->get('user-agent');
        $queries['seeder'] = $queries['left'] == 0;

        $self = $this->entityMangaer->getRepository(Peers::class)->findByAnnounce($sync->getUser(), $sync->getTorrent(), $queries['peer_id']);

        $torrent = $sync->getTorrent();
        $user = $sync->getUser();
        /** @var Snatched $snatched */
        $snatched = $this->entityMangaer->getRepository(Snatched::class)->findBy([
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
            $this->entityMangaer->persist($peer);

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
                $this->entityMangaer->persist($snatched);
            }
        }else{
            $thisUploaded = $trueUploaded = max(0, $queries['uploaded'] - $self->getUploaded());
            $thisDownloaded = $trueDownloaded = max(0, $queries['downloaded'] - $self->getDownloaded());

            if($queries['event'] === "stopped"){
                $this->entityMangaer->remove($self);
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
                $snatched->setLastAction();
                if($queries['left'] === 0)
                    $snatched->setSeedtime($snatched->getSeedtime() + $this->functions->date_to_seconds($snatched->getLastAction()));
                else
                    $snatched->setLeechtime($snatched->getLeechtime() + $this->functions->date_to_seconds($snatched->getLastAction()));
            }
        }

        if($queries['event'] === "completed"){
            $torrent->setSeeders($torrent->getSeeders() + 1);
            $torrent->setLeechers($torrent->getLeechers() - 1);
            $snatched->setCompletedat();
        }

        $user->setUploaded($user->getUploaded() + $thisUploaded);
        $user->setDownloaded($user->getDownloaded() + $thisDownloaded);
        if($this->memcached->cleanPeers()){
            $this->log_announce("Stats d= ". $trueDownloaded);
        }
        $this->entityMangaer->flush();
        return new Response($this->generateAnnounceResponse($queries, $torrent), 200, $this->headers);
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

        $peers = $this->entityMangaer->getRepository(Peers::class)->getAllPeers($queries, $torrent);

        foreach ($peers as $peer){
            if($queries['compact']){
                $peer_insert_field = filter_var($peer->getIp(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? "peers6" : "peers";
                $rep_dict[$peer_insert_field] .= inet_pton($peer->getIp()) . pack('n', $peer->getPort());
            }
        }
        return Bencode::encode($rep_dict);
    }

    private function calculateTorrentBonus($torrent, $user, $trueUploaded, $trueDownloaded, &$thisUploaded, &$thisDownloaded){
        if($torrent->getOwner() === $user) {
            $thisUploaded = $trueUploaded;
        }elseif($torrent['bonus'] === "freeleech" && timeDiff($torrent['bonus_expire']) < 0) {
            $thisUploaded = $trueUploaded;
        }elseif (json_decode($torrent['specs'], true)['format'] === "dvd" && $torrent['bonus'] === "silver") {
            $thisUploaded = $trueUploaded;
            $thisDownloaded = (int)(0.5 * $trueDownloaded);
        }elseif (json_decode($torrent['specs'], true)['format'] === "bdmv" && $torrent['bonus'] === "silver") {
            $thisUploaded = $trueUploaded;
            $thisDownloaded = (int)(0.25 * $trueDownloaded);
        }elseif (json_decode($torrent['specs'], true)['format'] === "bdmv"){
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
        $this->entityMangaer->persist($logs);
    }
    private function error($code, $replace = null): string
    {
        $message = $this->announce_error[$code];
        if(!$replace)
            return Bencode::encode(['failure reason' => $message]);
        foreach ($replace as $key => $value){
            $message = str_replace($key, $value, $message);
        }
        return Bencode::encode(['failure reason' => $message]);
    }
    private $announce_error = [
        100 => "Invalid :attr | :attr is not 20 bytes long",
        101 => "Invalid :attr | :attr must be >= 0",
        102 => 'Unsupported Event type :event .',
        103 => "Invalid passkey",
        104 => "Illegal port :port . Port should between 6881-64999",
        105 => "Illegal port 0 under Event type :event .",
        106 => "Torrent was removed" // TODO reason
    ];
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
}
