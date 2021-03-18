<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
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
     * @ORM\Column(type="string", length=255)
     */
    private $flagpic;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $siteLangFolder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $translationState;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="idLanguage")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getFlagpic(): ?string
    {
        return $this->flagpic;
    }

    public function setFlagpic(string $flagpic): self
    {
        $this->flagpic = $flagpic;

        return $this;
    }

    public function getSiteLangFolder(): ?string
    {
        return $this->siteLangFolder;
    }

    public function setSiteLangFolder(string $siteLangFolder): self
    {
        $this->siteLangFolder = $siteLangFolder;

        return $this;
    }

    public function getTranslationState(): ?string
    {
        return $this->translationState;
    }

    public function setTranslationState(string $translationState): self
    {
        $this->translationState = $translationState;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setIdLanguage($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getIdLanguage() === $this) {
                $user->setIdLanguage(null);
            }
        }

        return $this;
    }
}
