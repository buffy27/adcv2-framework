<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtFilesUsers
 *
 * @ORM\Table(name="xbt_files_users", indexes={@ORM\Index(name="fid_idx", columns={"fid"}), @ORM\Index(name="mtime_idx", columns={"mtime"}), @ORM\Index(name="remaining_idx", columns={"remaining"}), @ORM\Index(name="uid_active", columns={"uid", "active"})})
 * @ORM\Entity
 */
class XbtFilesUsers
{
    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uid;

    /**
     * @var binary
     *
     * @ORM\Column(name="peer_id", type="binary", nullable=false, options={"default"="0x"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $peerId = '0x';

    /**
     * @var int
     *
     * @ORM\Column(name="fid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fid;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="announced", type="integer", nullable=false)
     */
    private $announced;

    /**
     * @var bool
     *
     * @ORM\Column(name="completed", type="boolean", nullable=false, options={"default":0})
     */
    private $completed = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="downloaded", type="bigint", nullable=false, options={"default":0})
     */
    private $downloaded;

    /**
     * @var int
     *
     * @ORM\Column(name="remaining", type="bigint", nullable=false, options={"default":0})
     */
    private $remaining;

    /**
     * @var int
     *
     * @ORM\Column(name="uploaded", type="bigint", nullable=false, options={"default":0})
     */
    private $uploaded;

    /**
     * @var int
     *
     * @ORM\Column(name="upspeed", type="bigint", nullable=false, options={"default":0})
     */
    private $upspeed;

    /**
     * @var int
     *
     * @ORM\Column(name="downspeed", type="bigint", nullable=false, options={"default":0})
     */
    private $downspeed;

    /**
     * @var int
     *
     * @ORM\Column(name="corrupt", type="bigint", nullable=false, options={"default":0})
     */
    private $corrupt = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="timespent", type="bigint", nullable=false, options={"default":0})
     */
    private $timespent;

    /**
     * @var string
     *
     * @ORM\Column(name="useragent", type="string", length=51, nullable=false, options={"default":""})
     */
    private $useragent;

    /**
     * @var bool
     *
     * @ORM\Column(name="connectable", type="boolean", nullable=false, options={"default"="0"})
     */
    private $connectable = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ctime", type="integer", nullable=true)
     */
    private $ctime;

    /**
     * @var int
     *
     * @ORM\Column(name="mtime", type="integer", nullable=false)
     */
    private $mtime;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false, options={"default":""})
     */
    private $ip = '';

    /**
     * @var binary|null
     *
     * @ORM\Column(name="ipv4", type="binary", nullable=true)
     */
    private $ipv4;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="ipv6", type="binary", nullable=true)
     */
    private $ipv6;

    /**
     * @var int
     *
     * @ORM\Column(name="port", type="integer", nullable=false, options={"default":0})
     */
    private $port = '0';

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return binary
     */
    public function getPeerId()
    {
        return $this->peerId;
    }

    /**
     * @param binary $peerId
     */
    public function setPeerId($peerId): void
    {
        $this->peerId = $peerId;
    }

    /**
     * @return int
     */
    public function getFid(): int
    {
        return $this->fid;
    }

    /**
     * @param int $fid
     */
    public function setFid(int $fid): void
    {
        $this->fid = $fid;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getAnnounced(): int
    {
        return $this->announced;
    }

    /**
     * @param int $announced
     */
    public function setAnnounced(int $announced): void
    {
        $this->announced = $announced;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * @param bool $completed
     */
    public function setCompleted($completed): void
    {
        $this->completed = $completed;
    }

    /**
     * @return int
     */
    public function getDownloaded(): int
    {
        return $this->downloaded;
    }

    /**
     * @param int $downloaded
     */
    public function setDownloaded(int $downloaded): void
    {
        $this->downloaded = $downloaded;
    }

    /**
     * @return int
     */
    public function getRemaining(): int
    {
        return $this->remaining;
    }

    /**
     * @param int $remaining
     */
    public function setRemaining(int $remaining): void
    {
        $this->remaining = $remaining;
    }

    /**
     * @return int
     */
    public function getUploaded(): int
    {
        return $this->uploaded;
    }

    /**
     * @param int $uploaded
     */
    public function setUploaded(int $uploaded): void
    {
        $this->uploaded = $uploaded;
    }

    /**
     * @return int
     */
    public function getUpspeed(): int
    {
        return $this->upspeed;
    }

    /**
     * @param int $upspeed
     */
    public function setUpspeed(int $upspeed): void
    {
        $this->upspeed = $upspeed;
    }

    /**
     * @return int
     */
    public function getDownspeed(): int
    {
        return $this->downspeed;
    }

    /**
     * @param int $downspeed
     */
    public function setDownspeed(int $downspeed): void
    {
        $this->downspeed = $downspeed;
    }

    /**
     * @return int
     */
    public function getCorrupt()
    {
        return $this->corrupt;
    }

    /**
     * @param int $corrupt
     */
    public function setCorrupt($corrupt): void
    {
        $this->corrupt = $corrupt;
    }

    /**
     * @return int
     */
    public function getTimespent(): int
    {
        return $this->timespent;
    }

    /**
     * @param int $timespent
     */
    public function setTimespent(int $timespent): void
    {
        $this->timespent = $timespent;
    }

    /**
     * @return string
     */
    public function getUseragent(): string
    {
        return $this->useragent;
    }

    /**
     * @param string $useragent
     */
    public function setUseragent(string $useragent): void
    {
        $this->useragent = $useragent;
    }

    /**
     * @return bool
     */
    public function isConnectable(): bool
    {
        return $this->connectable;
    }

    /**
     * @param bool $connectable
     */
    public function setConnectable(bool $connectable): void
    {
        $this->connectable = $connectable;
    }

    /**
     * @return int|null
     */
    public function getCtime(): ?int
    {
        return $this->ctime;
    }

    /**
     * @param int|null $ctime
     */
    public function setCtime(?int $ctime): void
    {
        $this->ctime = $ctime;
    }

    /**
     * @return int
     */
    public function getMtime(): int
    {
        return $this->mtime;
    }

    /**
     * @param int $mtime
     */
    public function setMtime(int $mtime): void
    {
        $this->mtime = $mtime;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return binary|null
     */
    public function getIpv4(): ?binary
    {
        return $this->ipv4;
    }

    /**
     * @param binary|null $ipv4
     */
    public function setIpv4(?binary $ipv4): void
    {
        $this->ipv4 = $ipv4;
    }

    /**
     * @return binary|null
     */
    public function getIpv6(): ?binary
    {
        return $this->ipv6;
    }

    /**
     * @param binary|null $ipv6
     */
    public function setIpv6(?binary $ipv6): void
    {
        $this->ipv6 = $ipv6;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port): void
    {
        $this->port = $port;
    }



}
