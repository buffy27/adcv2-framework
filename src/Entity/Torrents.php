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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="bigint")
     */
    private $size;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    /**
     * @ORM\Column(type="integer")
     */
    private $seeders;

    /**
     * @ORM\Column(type="integer")
     */
    private $leechers;

    /**
     * @ORM\Column(type="string")
     */
    private $bonus;

    /**
     * @ORM\Column (type="array", name="specs")
     */
    private $specs = [];

    /**
     * @ORM\ManyToOne(targetEntity=TorrentsCategory::class, inversedBy="torrents")
     */
    private $tCategory;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="torrents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="text")
     */
    private $contentInfo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $infoHash;

    /**
     * @ORM\Column(type="integer")
     */
    private $contentId;

    /**
     * @ORM\OneToMany(targetEntity=TorrentComments::class, mappedBy="torrents")
     */
    private $idComment;

    public function __construct()
    {
        $this->idComment = new ArrayCollection();
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

    public function setBonus(string $bonus): self
    {
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

    public function getContentId(): ?int
    {
        return $this->contentId;
    }

    public function setContentId(int $contentId = null): self
    {
        if(!$contentId)
            $this->contentId = 0;
        else
            $this->contentId = $contentId;

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

}
