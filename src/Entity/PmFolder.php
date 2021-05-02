<?php

namespace App\Entity;

use App\Repository\PmFolderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PmFolderRepository::class)
 */
class PmFolder
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
     * @ORM\OneToMany(targetEntity=PmTo::class, mappedBy="folder")
     */
    private $pmTos;

    public function __construct()
    {
        $this->pmTos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|PmTo[]
     */
    public function getPmTos(): Collection
    {
        return $this->pmTos;
    }

    public function addPmTo(PmTo $pmTo): self
    {
        if (!$this->pmTos->contains($pmTo)) {
            $this->pmTos[] = $pmTo;
            $pmTo->setFolder($this);
        }

        return $this;
    }

    public function removePmTo(PmTo $pmTo): self
    {
        if ($this->pmTos->removeElement($pmTo)) {
            // set the owning side to null (unless already changed)
            if ($pmTo->getFolder() === $this) {
                $pmTo->setFolder(null);
            }
        }

        return $this;
    }
}
