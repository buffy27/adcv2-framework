<?php

namespace App\Entity;

use App\Repository\TorrentsRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="text", name="desc")
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
     * @ORM\Column (type="json", name="specs")
     */
    private $specs;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSpecs()
    {
        return $this->specs;
    }

    /**
     * @param mixed $specs
     */
    public function setSpecs($specs): void
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getAdded(): ?\DateTimeInterface
    {
        return $this->added;
    }

    public function setAdded(\DateTimeInterface $added): self
    {
        $this->added = $added;

        return $this;
    }

    public function getSeeders(): ?int
    {
        return $this->seeders;
    }

    public function setSeeders(int $seeders): self
    {
        $this->seeders = $seeders;

        return $this;
    }

    public function getLeechers(): ?int
    {
        return $this->leechers;
    }

    public function setLeechers(int $leechers): self
    {
        $this->leechers = $leechers;

        return $this;
    }

    public function getBonus()
    {
        return $this->bonus;
    }

    public function setBonus(array $bonus): self
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

    public function setContentInfo(string $contentInfo): self
    {
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

    public function setContentId(int $contentId): self
    {
        $this->contentId = $contentId;

        return $this;
    }
}
