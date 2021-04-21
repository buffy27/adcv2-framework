<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersSlots
 *
 * @ORM\Table(name="users_slots")
 * @ORM\Entity
 */
class UsersSlots
{
    /**
     * @var int
     *
     * @ORM\Column(name="UserID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="TorrentID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $torrentid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FreeLeech", type="datetime", nullable=true)
     */
    private $freeleech;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DoubleSeed", type="datetime", nullable=true)
     */
    private $doubleseed;


}
