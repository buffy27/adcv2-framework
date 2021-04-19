<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtClientBlacklist
 *
 * @ORM\Table(name="xbt_client_blacklist", uniqueConstraints={@ORM\UniqueConstraint(name="peer_id", columns={"peer_id"})})
 * @ORM\Entity
 */
class XbtClientBlacklist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="peer_id", type="string", length=20, nullable=true)
     */
    private $peerId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vstring", type="string", length=200, nullable=true)
     */
    private $vstring = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getPeerId(): ?string
    {
        return $this->peerId;
    }

    /**
     * @param string|null $peerId
     */
    public function setPeerId(?string $peerId): void
    {
        $this->peerId = $peerId;
    }

    /**
     * @return string|null
     */
    public function getVstring(): ?string
    {
        return $this->vstring;
    }

    /**
     * @param string|null $vstring
     */
    public function setVstring(?string $vstring): void
    {
        $this->vstring = $vstring;
    }
}
