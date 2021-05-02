<?php

namespace App\Entity;

use App\Repository\PmBoxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PmBoxRepository::class)
 */
class PmBox
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    /**
     * @ORM\OneToMany(targetEntity=PmTo::class, mappedBy="message")
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

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
            $pmTo->setMessage($this);
        }

        return $this;
    }

    public function removePmTo(PmTo $pmTo): self
    {
        if ($this->pmTos->removeElement($pmTo)) {
            // set the owning side to null (unless already changed)
            if ($pmTo->getMessage() === $this) {
                $pmTo->setMessage(null);
            }
        }

        return $this;
    }
}
