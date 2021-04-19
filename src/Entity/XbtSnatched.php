<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XbtSnatched
 *
 * @ORM\Table(name="xbt_snatched", indexes={@ORM\Index(name="fid", columns={"fid"}), @ORM\Index(name="tstamp", columns={"tstamp"}), @ORM\Index(name="uid", columns={"uid"})})
 * @ORM\Entity
 */
class XbtSnatched
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
     * @ORM\Column(name="uid", type="integer", nullable=false, options={"default":0})
     */
    private $uid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="tstamp", type="integer", nullable=false)
     */
    private $tstamp;

    /**
     * @var int
     *
     * @ORM\Column(name="fid", type="integer", nullable=false, options={"default":0})
     */
    private $fid;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="ipv6", type="binary", nullable=true)
     */
    private $ipv6;

    /**
     * @var binary|null
     *
     * @ORM\Column(name="ipv4", type="binary", nullable=true)
     */
    private $ipv4;

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
