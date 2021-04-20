<?php


namespace App\Libraries;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AnnounceFunctions extends AbstractController
{
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    function addUser($passkey, $userid) {
        $params = ['passkey'  => $passkey,
            'id'       => $userid];
        if ($this->validateParams($params)) {
            $response = $this->update('add_user', $params);
            return empty($response) ? false : $response;
        }
        return false;
    }
    public function addTorrent($tid, $infohash): bool
    {
        $params = ['id'             => $tid,
            'info_hash'      => $infohash,
            'bonus' => "normal"
        ];

        if ($this->validateParams($params)) {
            return $this->update('add_torrent', $params);
        }
        return false;
    }
    public function updateTorrent($infohash, $bonus) {
        $params = ['info_hash'      => $infohash,
            'bonus'    => $bonus];

        if ($this->validateParams($params)) {
            return $this->update('update_torrent', $params);
        }
        return false;
    }
    public function deleteTorrent($infohash) {
        // @param $reason int The reason for deleting
        // a code for the delete reason - atm the codes defined in the tracker are whatcd related
        // ['reason'  => $reason];
        $params = ['info_hash'  => $infohash];

        if ($this->validateParams($params)) {
            return $this->update('delete_torrent', $params);
        }
        return false;
    }
    private function send($Get) {
        $StartTime = microtime(true);
        try {
            $response = $this->client->request('GET', $this->getParameter('app.announce_url') . $Get);
        } catch (TransportExceptionInterface $e) {
            return false;
        }

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300 || $response->getStatusCode() == 500) {
            $Request = array(
                'path' => substr($Get, strpos($Get, '/')),
                'response' => $response,
                'status' => $response->getStatusCode(),
                'time' => 1000 * (microtime(true) - $StartTime)
            );
            return $Request;
         }
        elseif ($response->getStatusCode() === 503){
            return ['error' => "Announce is unavailable at the moment"];
        }
        else{
            return ['error' => "Unknown error occurred, contact the SysOP."];
        }
    }
    private function update($Action, $Updates)
    {
        $Get = $this->getParameter('app.announce_pw') . "/update?action=$Action";
        foreach ($Updates as $Key => $Value) {
            $Get .= "&$Key=$Value";
        }
        return $this->send($Get);
    }
    private function validateParams($params): bool
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'id':
                case 'userid':
                case 'new_announce_interval':
                    // > 0
                    if (!$value || !is_numeric($value)) return false;
                    break;
                case 'info_hash':
                    // 40 digit hex (when unpacked)

                    if (strlen($value) != 40) {
                        //debug only
                        //write_log("Failed to validate infohash: $unp");
                        return false;
                    }
                    break;
                case 'info_hashes':
                    // 40 digit hex * 1->many (when unpacked)
                    $unp = unpack("H*", $value)[1];
                    if (!preg_match('/^([0-9a-f]{40})+$/i', $unp)) {
                        //debug only
                        //write_log("Failed to validate infohashes: $unp");
                        return false;
                    }
                    break;
                case 'bonus':
                    if (!in_array($value, ['freeleech','silver','normal'])) return false;
                    break;
                case 'doubletorrent':
                case 'can_leech':
                case 'visible':
                case 'track_ipv6':
                    if (!in_array($value, [0,1])) return false;
                    break;
                case 'time':
                    // >= 0
                    if (!is_numeric($value)) return false;
                    break;
                case 'passkey':
                case 'oldpasskey':
                case 'newpasskey':
                    // 32 digit alphanumeric
                    if (!preg_match('/^[0-9a-z]{128}$/i', $value)) {
                        //debug only
                        //write_log("Failed to validate passkey: $value");
                        return false;
                    }
                    break;
                case 'passkeys':
                    // 128 digit alphanumeric * 1->many
                    if (!preg_match('/^([0-9a-z]{128})+$/i', $value)) {
                        //debug only
                        //write_log("Failed to validate passkeys: $value");
                        return false;
                    }
                    break;
                case 'peer_id':
                case 'old_peer_id':
                case 'new_peer_id':
                    // string up to 20 bytes
                    if (strlen($value)>20) return false;
                    break;
                default:
                    return false;
            }
        }
        return true;
    }
}