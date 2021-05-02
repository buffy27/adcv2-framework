<?php

namespace App\Entity;

use App\Repository\PmToRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PmToRepository::class)
 */
class PmTo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PmBox::class, inversedBy="pmTos")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $receiver;

    /**
     * @ORM\ManyToOne(targetEntity=PmFolder::class, inversedBy="pmTos")
     */
    private $folder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $PmRead;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?PmBox
    {
        return $this->message;
    }

    public function setMessage(?PmBox $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender = null): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getFolder(): ?PmFolder
    {
        return $this->folder;
    }

    public function setFolder(?PmFolder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    public function getPmRead(): ?bool
    {
        return $this->PmRead;
    }

    public function setPmRead(bool $PmRead): self
    {
        $this->PmRead = $PmRead;

        return $this;
    }
}
