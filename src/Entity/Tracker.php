<?php

namespace App\Entity;

use App\Repository\TrackerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrackerRepository::class)
 */
class Tracker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $globalSignup;

    /**
     * @ORM\Column(type="boolean")
     */
    private $trackerStatus;

    /**
     * @ORM\Column(type="integer")
     */
    private $userLimit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlobalSignup(): ?bool
    {
        return $this->globalSignup;
    }

    public function setGlobalSignup(bool $globalSignup): self
    {
        $this->globalSignup = $globalSignup;

        return $this;
    }

    public function getTrackerStatus(): ?bool
    {
        return $this->trackerStatus;
    }

    public function setTrackerStatus(bool $trackerStatus): self
    {
        $this->trackerStatus = $trackerStatus;

        return $this;
    }

    public function getUserLimit(): ?int
    {
        return $this->userLimit;
    }

    public function setUserLimit(int $userLimit): self
    {
        $this->userLimit = $userLimit;

        return $this;
    }
}
