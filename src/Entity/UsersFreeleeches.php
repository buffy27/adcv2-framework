<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersFreeleeches
 *
 * @ORM\Table(name="users_freeleeches")
 * @ORM\Entity
 */
class UsersFreeleeches
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
     * @var int
     *
     * @ORM\Column(name="Downloaded", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $downloaded = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Uploaded", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $uploaded = '0';


}
