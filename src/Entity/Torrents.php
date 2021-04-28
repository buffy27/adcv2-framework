<?php

namespace App\Entity;

use App\Repository\TorrentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Serializable;

/**
 * @ORM\Entity(repositoryClass=TorrentsRepository::class)
 */
class Torrents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, options={"default":""})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $size;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $added;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $seeders;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $leechers;

    /**
     * @ORM\Column(type="string", options={"default":"normal"})
     */
    private $bonus;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $specs = [];

    /**
     * @ORM\ManyToOne(targetEntity=TorrentsCategory::class, inversedBy="torrents")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tCategory;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="torrents")
     * @ORM\JoinColumn(nullable=true)
     */
    private $owner;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoHash;

    /**
     * @ORM\OneToMany(targetEntity=TorrentComments::class, mappedBy="torrents")
     * @ORM\JoinColumn (nullable=true)
     */
    private $idComment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contentPoster;

    /**
     * @ORM\Column(type="text", nullable=true, nullable=true)
     */
    private $mediaInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contentUrl;

    /**
     * @ORM\OneToMany(targetEntity=SyncAnnounce::class, mappedBy="torrent")
     * @ORM\JoinColumn(nullable=true)
     */
    private $syncAnnounces;

    /**
     * @ORM\OneToMany(targetEntity=Peers::class, mappedBy="torrent")
     * @ORM\JoinColumn(nullable=true)
     */
    private $peers;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $Snatched;

    /** 
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $DoubleTorrent;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $Balance;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $LastAction;

    /**
     * @ORM\OneToMany(targetEntity=Snatched::class, mappedBy="torrent")
     */
    private $snatcheds;

    public function __construct()
    {
        $this->idComment = new ArrayCollection();
        $this->syncAnnounces = new ArrayCollection();
        $this->peers = new ArrayCollection();
        $this->snatcheds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getSpecs(): array
    {
        return $this->specs;
    }

    /**
     * @param array $specs
     */
    public function setSpecs(array $specs): void
    {
        $this->specs = $specs;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null): self
    {
        if(!$description)
            $this->description = "";
        else
            $this->description = $description;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

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

    public function getSeeders(): ?int
    {
        return $this->seeders;
    }

    public function setSeeders(int $seeders = null): self
    {
        if(!$seeders)
            $this->seeders = 0;
        else
            $this->seeders = $seeders;

        return $this;
    }

    public function getLeechers(): ?int
    {
        return $this->leechers;
    }

    public function setLeechers(int $leechers = null): self
    {
        if(!$leechers)
            $this->leechers = 0;
        else
            $this->leechers = $leechers;

        return $this;
    }

    public function getBonus()
    {
        return $this->bonus;
    }

    public function setBonus(string $bonus = null): self
    {
        if(!$bonus)
            $this->bonus = "normal";
        else
            $this->bonus = $bonus;

        return $this;
    }

    public function getTCategory(): ?TorrentsCategory
    {
        return $this->tCategory;
    }

    public function setTCategory(?TorrentsCategory $tCategory): self
    {
        $this->tCategory = $tCategory;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getContentInfo(): ?string
    {
        return $this->contentInfo;
    }

    public function setContentInfo(string $contentInfo = null): self
    {
        if(!$contentInfo)
            $this->contentInfo = "";
        else
            $this->contentInfo = $contentInfo;

        return $this;
    }

    public function getInfoHash(): ?string
    {
        return $this->infoHash;
    }

    public function setInfoHash(string $infoHash): self
    {
        $this->infoHash = $infoHash;

        return $this;
    }

    /**
     * @return Collection|TorrentComments[]
     */
    public function getIdComment(): Collection
    {
        return $this->idComment;
    }

    public function addIdComment(TorrentComments $idComment): self
    {
        if (!$this->idComment->contains($idComment)) {
            $this->idComment[] = $idComment;
            $idComment->setTorrents($this);
        }

        return $this;
    }

    public function removeIdComment(TorrentComments $idComment): self
    {
        if ($this->idComment->removeElement($idComment)) {
            // set the owning side to null (unless already changed)
            if ($idComment->getTorrents() === $this) {
                $idComment->setTorrents(null);
            }
        }

        return $this;
    }

    public function getContentPoster(): ?string
    {
        return $this->contentPoster;
    }

    public function setContentPoster(string $contentPoster = null): self
    {
        if(!$contentPoster)
            $this->contentPoster = "";
        else
            $this->contentPoster = $contentPoster;

        return $this;
    }

    public function getMediaInfo(): ?string
    {
        return $this->mediaInfo;
    }

    public function setMediaInfo(string $mediaInfo): self
    {
        $this->mediaInfo = $mediaInfo;

        return $this;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(string $contentUrl = null): self
    {
        if(!$contentUrl)
            $this->contentUrl = "";
        else
            $this->contentUrl = $contentUrl;

        return $this;
    }

    /**
     * @return Collection|SyncAnnounce[]
     */
    public function getSyncAnnounces(): Collection
    {
        return $this->syncAnnounces;
    }

    public function addSyncAnnounce(SyncAnnounce $syncAnnounce): self
    {
        if (!$this->syncAnnounces->contains($syncAnnounce)) {
            $this->syncAnnounces[] = $syncAnnounce;
            $syncAnnounce->setTorrent($this);
        }

        return $this;
    }

    public function removeSyncAnnounce(SyncAnnounce $syncAnnounce): self
    {
        if ($this->syncAnnounces->removeElement($syncAnnounce)) {
            // set the owning side to null (unless already changed)
            if ($syncAnnounce->getTorrent() === $this) {
                $syncAnnounce->setTorrent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Peers[]
     */
    public function getPeers(): Collection
    {
        return $this->peers;
    }

    public function addPeer(Peers $peer): self
    {
        if (!$this->peers->contains($peer)) {
            $this->peers[] = $peer;
            $peer->setTorrent($this);
        }

        return $this;
    }

    public function removePeer(Peers $peer): self
    {
        if ($this->peers->removeElement($peer)) {
            // set the owning side to null (unless already changed)
            if ($peer->getTorrent() === $this) {
                $peer->setTorrent(null);
            }
        }

        return $this;
    }

    public function getSnatched(): ?int
    {
        return $this->Snatched;
    }

    public function setSnatched(int $Snatched): self
    {
        $this->Snatched = $Snatched;

        return $this;
    }

    public function getDoubleTorrent(): ?bool
    {
        return $this->DoubleTorrent;
    }

    public function setDoubleTorrent(bool $DoubleTorrent): self
    {
        $this->DoubleTorrent = $DoubleTorrent;

        return $this;
    }

    public function getBalance(): ?string
    {
        return $this->Balance;
    }

    public function setBalance(string $Balance): self
    {
        $this->Balance = $Balance;

        return $this;
    }

    public function getLastAction(): ?\DateTimeInterface
    {
        return $this->LastAction;
    }

    public function setLastAction(\DateTimeInterface $LastAction = null): self
    {
        if(!$LastAction)
            $this->LastAction = new \DateTime('now');
        else
            $this->LastAction = $LastAction;

        return $this;
    }

    /**
     * @return Collection|Snatched[]
     */
    public function getSnatcheds(): Collection
    {
        return $this->snatcheds;
    }

    public function addSnatched(Snatched $snatched): self
    {
        if (!$this->snatcheds->contains($snatched)) {
            $this->snatcheds[] = $snatched;
            $snatched->setTorrent($this);
        }

        return $this;
    }

    public function removeSnatched(Snatched $snatched): self
    {
        if ($this->snatcheds->removeElement($snatched)) {
            // set the owning side to null (unless already changed)
            if ($snatched->getTorrent() === $this) {
                $snatched->setTorrent(null);
            }
        }

        return $this;
    }
}
