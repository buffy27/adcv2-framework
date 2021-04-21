<?php

namespace App\Entity;

use App\Repository\XbtPeersHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=XbtPeersHistoryRepository::class)
 */
class XbtPeersHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="xbtPeersHistories")
     * @ORM\JoinColumn (onDelete="CASCADE", nullable=true, name="uid")
     */
    private $uid;

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
    private $timespent;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $peer_id;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $ipv4;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $ipv6;

    /**
     * @ORM\ManyToOne(targetEntity=Torrents::class, inversedBy="xbtPeersHistories")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE", name="fid")
     */
    private $fid;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $mtime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?User
    {
        return $this->uid;
    }

    public function setUid(?User $uid): self
    {
        $this->uid = $uid;

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

    public function getTimespent(): ?string
    {
        return $this->timespent;
    }

    public function setTimespent(string $timespent): self
    {
        $this->timespent = $timespent;

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

    public function getFid(): ?Torrents
    {
        return $this->fid;
    }

    public function setFid(?Torrents $fid): self
    {
        $this->fid = $fid;

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
}
