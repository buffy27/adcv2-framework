<?php

namespace App\Entity;

use App\Repository\PeersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeersRepository::class)
 */
class Peers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="binary")
     */
    private $peerId;

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
    private $downloaded;

    /**
     * @ORM\Column(type="bigint")
     */
    private $uploaded;

    /**
     * @ORM\Column(type="bigint")
     */
    private $toGo;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $seeder;

    /**
     * @ORM\Column(type="datetime")
     */
    private $started;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastAction;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $connectable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agent;

    /**
     * @ORM\ManyToOne(targetEntity=Torrents::class, inversedBy="peers")
     * @ORM\JoinColumn (onDelete="CASCADE")
     */
    private $torrent;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="peers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeerId()
    {
        return $this->peerId;
    }

    public function setPeerId($peerId): self
    {
        $this->peerId = $peerId;

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

    public function getDownloaded(): ?string
    {
        return $this->downloaded;
    }

    public function setDownloaded(string $downloaded = null): self
    {
        if(!$downloaded)
            $this->downloaded = 0;
        else
            $this->downloaded = $downloaded;

        return $this;
    }

    public function getUploaded(): ?string
    {
        return $this->uploaded;
    }

    public function setUploaded(string $uploaded = null): self
    {
        if(!$uploaded)
            $this->uploaded = 0;
        else
            $this->uploaded = $uploaded;

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

    public function getSeeder(): ?string
    {
        return $this->seeder;
    }

    public function setSeeder(string $seeder): self
    {
        $this->seeder = $seeder;

        return $this;
    }

    public function getStarted(): ?\DateTimeInterface
    {
        return $this->started;
    }

    public function setStarted(\DateTimeInterface $started = null): self
    {
        if(!$started)
            $this->started = new \DateTime('now');
        else
            $this->started = $started;
        return $this;
    }

    public function getLastAction(): ?\DateTimeInterface
    {
        return $this->lastAction;
    }

    public function setLastAction(\DateTimeInterface $lastAction = null): self
    {
        if(!$lastAction)
            $this->lastAction = new \DateTime('now');
        else
            $this->lastAction = $lastAction;
        return $this;
    }

    public function getConnectable(): ?string
    {
        return $this->connectable;
    }

    public function setConnectable(string $connectable): self
    {
        $this->connectable = $connectable;

        return $this;
    }

    public function getAgent(): ?string
    {
        return $this->agent;
    }

    public function setAgent(string $agent): self
    {
        $this->agent = $agent;

        return $this;
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
}
