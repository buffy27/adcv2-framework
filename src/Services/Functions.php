<?php


namespace App\Services;


use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\Translation\t;

class Functions
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function timeago(\DateTime $date) {

        $timestamp = strtotime($date->format('Y-m-d H:i:s'));

        $strTime = array("second", "minute", "hour", "day", "month", "year");
        $length = array("60","60","24","30","12","10");

        $currentTime = time();
        if($currentTime >= $timestamp) {
            $diff     = time()- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago";
        }
    }
    public function timeago_short($date) {
        if(is_numeric($date)){
            $date = DateTime::createFromFormat( 'U', $date);
        }
        $timestamp = strtotime($date->format('Y-m-d H:i:s'));

        $strTime = array("s", "m", "h", "d", "M", "Y");
        $length = array("60","60","24","30","12","10");

        $currentTime = time();
        if($currentTime >= $timestamp) {
            $diff     = time()- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago";
        }
    }
    public function date_to_seconds($date)
    {
        if(is_string($date))
            $t1 = new DateTime($date);
        else
            $t1 = $date;

        $t2 = new DateTime('now');
        $interval = $t1->diff($t2);
        $types = array('%y', '%m', '%d', '%h', '%i', '%s');

        $out = 0;
        foreach ($types as $value) {
            if ($interval->format($value)) {
                switch ($value) {
                    case '%h':
                        $out += $interval->format($value) * 60 * 60;
                        break;
                    case '%i':
                        $out += $interval->format($value) * 60;
                        break;
                    case '%s':
                        $out += $interval->format($value);
                        break;
                }
            }
        }
        return $out;
    }
    public function mksecret($len = 20)
    {
        $ret = "";
        for ($i = 0; $i < $len; $i++)
            $ret .= chr(random_int(33, 126));
        return $ret;
    }
    public function formatBytes($size, $precision = 2)
    {
        if (empty($size))
            return 0;
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        $out = round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
        return $out;
    }
}