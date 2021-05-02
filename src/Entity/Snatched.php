<?php

namespace App\Entity;

use App\Repository\SnatchedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SnatchedRepository::class)
 */
class Snatched
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Torrents::class, inversedBy="snatcheds")
     * @ORM\JoinColumn (onDelete="CASCADE")
     */
    private $torrent;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="snatcheds")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $ip;

    /**
     * @ORM\Column(type="integer")
     */
    private $port;

    /**
     * @ORM\Column(type="bigint")
     */
    private $uploaded;

    /**
     * @ORM\Column(type="bigint")
     */
    private $downloaded;

    /**
     * @ORM\Column(type="bigint")
     */
    private $toGo;

    /**
     * @ORM\Column(type="integer")
     */
    private $seedtime;

    /**
     * @ORM\Column(type="integer")
     */
    private $leechtime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_action;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startdat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $completedat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTorrent(): ?Torrents
    {
        return $this->torrent;
    }

    public function setTorrent(?Torrents $torrent): self
    {
        $this->torrent = $torrent;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

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

    public function getDownloaded(): ?string
    {
        return $this->downloaded;
    }

    public function setDownloaded(string $downloaded): self
    {
        $this->downloaded = $downloaded;

        return $this;
    }

    public function getToGo(): ?string
    {
        return $this->toGo;
    }

    public function setToGo(string $toGo): self
    {
        $this->toGo = $toGo;

        return $this;
    }

    public function getSeedtime(): ?int
    {
        return $this->seedtime;
    }

    public function setSeedtime(int $seedtime): self
    {
        $this->seedtime = $seedtime;

        return $this;
    }

    public function getLeechtime(): ?int
    {
        return $this->leechtime;
    }

    public function setLeechtime(int $leechtime): self
    {
        $this->leechtime = $leechtime;

        return $this;
    }

    public function getLastAction(): ?\DateTimeInterface
    {
        return $this->last_action;
    }

    public function setLastAction(\DateTimeInterface $last_action = null): self
    {
        if(!$last_action)
            $this->last_action = new \DateTime('now');
        else
            $this->last_action = $last_action;

        return $this;
    }

    public function getStartdat(): ?\DateTimeInterface
    {
        return $this->startdat;
    }

    public function setStartdat(\DateTimeInterface $startdat = null): self
    {
        if(!$startdat)
            $this->startdat = new \DateTime('now');
        else
            $this->startdat = $startdat;

        return $this;
    }

    public function getCompletedat(): ?\DateTimeInterface
    {
        return $this->completedat;
    }

    public function setCompletedat(\DateTimeInterface $completedat = null): self
    {
        if(!$completedat)
            $this->completedat = new \DateTime('now');
        else
            $this->completedat = $completedat;

        return $this;
    }
}
