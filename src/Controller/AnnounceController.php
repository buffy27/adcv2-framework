<?php

namespace App\Controller;


use App\Entity\Logs;
use App\Entity\SyncAnnounce;
use App\Exceptions\TrackerException;
use Doctrine\ORM\EntityManagerInterface;
use Rhilip\Bencode\Bencode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnounceController extends AbstractController
{
    private $headers = [
        'Content-Type' => 'text/plain; charset=utf-8',
        'Pragma' => 'no-cache'
    ];

    private $entityMangaer;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityMangaer = $entityManager;
    }
    /**
     * @Route("/announce/{passkey}", name="announce", methods={"GET"})
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
        $queries = [
            'timestamp' => $request->server->get('REQUEST_TIME_FLOAT')
        ];

        $sync = $this->entityMangaer->getRepository(SyncAnnounce::class)->findByDataPasskey($passkey);
        if(!isset($sync)){
            return new Response(Bencode::encode(['failure reason'=>'Invalid passkey']), 200, $this->headers);
        }

        foreach (['info_hash', 'peer_id', 'port', 'uploaded', 'downloaded', 'left'] as $item) {
            $item_data = $request->query->get($item);
            if (!is_null($item_data)) {
                $queries[$item] = $item_data;
            } else {
                return new Response(Bencode::encode(['failure reason'=>'null idata']), 200, $this->headers);
            }
        }
        $this->log_announce("");

        $this->entityMangaer->flush();
        return new Response(Bencode::encode(['failure reason'=>'EOF']), 200, $this->headers);
    }
    private function log_announce($log){
        $logs = new Logs();
        $logs->setLog($log);
        $logs->setAdded();
        $this->entityMangaer->persist($logs);
    }
}
