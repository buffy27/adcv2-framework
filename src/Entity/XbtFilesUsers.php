<?php

namespace App\Entity;

use App\Repository\XbtFilesUsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=XbtFilesUsersRepository::class)
 */
class XbtFilesUsers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="xbtFilesUsers")
     * @ORM\JoinColumn(name="uid", onDelete="CASCADE")
     */
    private $uid;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity=Torrents::class, inversedBy="xbtFilesUsers")
     * @ORM\JoinColumn(name="fid", onDelete="CASCADE")
     */
    private $fid;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $active;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $announced;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $completed;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $downloaded;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $remaining;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $uploaded;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $upspeed;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $downspeed;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $corrupt;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $timespent;

    /**
     * @ORM\Column(type="string", length=255, options={"default":""})
     */
    private $useragent;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $connectable;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $peer_id;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $ctime;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $mtime;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $ip;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $ipv4;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $ipv6;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $port;


    public function getUid(): ?User
    {
        return $this->uid;
    }

    public function setUid(?User $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getFid(): ?Torrents
    {
        return $this->fid;
    }

    public function setFid(?Torrents $fid): self
    {
        $this->fid = $fid;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAnnounced(): ?int
    {
        return $this->announced;
    }

    public function setAnnounced(int $announced): self
    {
        $this->announced = $announced;

        return $this;
    }

    public function getCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getDownloaded(): ?string
    {
        return $this->downloaded;
    }

    public function setDownloaded(string $downloaded): self
    {
        $this->downloaded = $downloaded;

        return $this;
    }

    public function getRemaining(): ?string
    {
        return $this->remaining;
    }

    public function setRemaining(string $remaining): self
    {
        $this->remaining = $remaining;

        return $this;
    }

    public function getUploaded(): ?string
    {
        return $this->uploaded;
    }

    public function setUploaded(string $uploaded): self
    {
        $this->uploaded = $uploaded;

        return $this;
    }

    public function getUpspeed(): ?string
    {
        return $this->upspeed;
    }

    public function setUpspeed(string $upspeed): self
    {
        $this->upspeed = $upspeed;

        return $this;
    }

    public function getDownspeed(): ?string
    {
        return $this->downspeed;
    }

    public function setDownspeed(string $downspeed): self
    {
        $this->downspeed = $downspeed;

        return $this;
    }

    public function getCorrupt(): ?string
    {
        return $this->corrupt;
    }

    public function setCorrupt(string $corrupt): self
    {
        $this->corrupt = $corrupt;

        return $this;
    }

    public function getTimespent(): ?string
    {
        return $this->timespent;
    }

    public function setTimespent(string $timespent): self
    {
        $this->timespent = $timespent;

        return $this;
    }

    public function getUseragent(): ?string
    {
        return $this->useragent;
    }

    public function setUseragent(string $useragent): self
    {
        $this->useragent = $useragent;

        return $this;
    }

    public function getConnectable(): ?bool
    {
        return $this->connectable;
    }

    public function setConnectable(bool $connectable): self
    {
        $this->connectable = $connectable;

        return $this;
    }

    public function getPeerId()
    {
        return $this->peer_id;
    }

    public function setPeerId($peer_id): self
    {
        $this->peer_id = $peer_id;

        return $this;
    }

    public function getCtime(): ?int
    {
        return $this->ctime;
    }

    public function setCtime(int $ctime): self
    {
        $this->ctime = $ctime;

        return $this;
    }

    public function getMtime(): ?int
    {
        return $this->mtime;
    }

    public function setMtime(int $mtime): self
    {
        $this->mtime = $mtime;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIpv4()
    {
        return $this->ipv4;
    }

    public function setIpv4($ipv4): self
    {
        $this->ipv4 = $ipv4;

        return $this;
    }

    public function getIpv6()
    {
        return $this->ipv6;
    }

    public function setIpv6($ipv6): self
    {
        $this->ipv6 = $ipv6;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }
}
