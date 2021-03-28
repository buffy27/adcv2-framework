<?php

namespace App\Entity;

use App\Repository\SyncAnnounceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SyncAnnounceRepository::class)
 */
class SyncAnnounce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $data_passkey;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="syncAnnounces")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Torrents::class, inversedBy="syncAnnounces")
     */
    private $torrent;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataPasskey(): ?string
    {
        return $this->data_passkey;
    }

    public function setDataPasskey(string $data_passkey): self
    {
        $this->data_passkey = $data_passkey;

        return $this;
    }

    public function getAdded(): ?\DateTimeInterface
    {
        return $this->added;
    }

    public function setAdded(\DateTimeInterface $added = null): self
    {
        if(!$added)
            $this->added = new \DateTime('now');
        else
            $this->added = $added;

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

    public function getTorrent(): ?Torrents
    {
        return $this->torrent;
    }

    public function setTorrent(?Torrents $torrent): self
    {
        $this->torrent = $torrent;

        return $this;
    }
}
