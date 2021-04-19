<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtPeersHistory
 *
 * @ORM\Table(name="xbt_peers_history", indexes={@ORM\Index(name="fid", columns={"fid"}), @ORM\Index(name="mtime", columns={"mtime"}), @ORM\Index(name="uid", columns={"uid"}), @ORM\Index(name="upspeed", columns={"upspeed"})})
 * @ORM\Entity
 */
class XbtPeersHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var int
     *
     * @ORM\Column(name="downloaded", type="bigint", nullable=false, options={"default":0})
     */
    private $downloaded;

    /**
     * @var int
     *
     * @ORM\Column(name="remaining", type="bigint", nullable=false, options={"default":0})
     */
    private $remaining;

    /**
     * @var int
     *
     * @ORM\Column(name="uploaded", type="bigint", nullable=false, options={"default":0})
     */
    private $uploaded;

    /**
     * @var int
     *
     * @ORM\Column(name="upspeed", type="bigint", nullable=false, options={"default":0})
     */
    private $upspeed;

    /**
     * @var int
     *
     * @ORM\Column(name="downspeed", type="bigint", nullable=false, options={"default":0})
     */
    private $downspeed;

    /**
     * @var int
     *
     * @ORM\Column(name="timespent", type="bigint", nullable=false, options={"default":0})
     */
    private $timespent;

    /**
     * @var binary
     *
     * @ORM\Column(name="peer_id", type="binary", nullable=false, options={"default"="0x"})
     */
    private $peerId = '0x';

    /**
     * @var binary|null
     *
     * @ORM\Column(name="ipv4", type="binary", nullable=true)
     */
    private $ipv4;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="ipv6", type="binary", nullable=true)
     */
    private $ipv6;

    /**
     * @var int
     *
     * @ORM\Column(name="fid", type="integer", nullable=false, options={"default":0})
     */
    private $fid;

    /**
     * @var int
     *
     * @ORM\Column(name="mtime", type="integer", nullable=false, options={"default":0})
     */
    private $mtime;

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
}
