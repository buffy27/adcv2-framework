<?php

namespace App\Entity;

use App\Repository\InvitesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvitesRepository::class)
 */
class Invites
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
    private $invite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="invites")
     */
    private $inviter;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $invitee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvite(): ?string
    {
        return $this->invite;
    }

    public function setInvite(string $invite): self
    {
        $this->invite = $invite;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getExpires(): ?\DateTimeInterface
    {
        return $this->expires;
    }

    public function setExpires(\DateTimeInterface $expires): self
    {
        $this->expires = $expires;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getInviter(): ?User
    {
        return $this->inviter;
    }

    public function setInviter(?User $inviter): self
    {
        $this->inviter = $inviter;

        return $this;
    }

    public function getInvitee(): ?User
    {
        return $this->invitee;
    }

    public function setInvitee(?User $invitee = null): self
    {
        $this->invitee = $invitee;

        return $this;
    }
}
