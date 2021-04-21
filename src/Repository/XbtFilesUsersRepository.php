<?php

namespace App\Repository;

use App\Entity\XbtFilesUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtFilesUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtFilesUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtFilesUsers[]    findAll()
 * @method XbtFilesUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtFilesUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtFilesUsers::class);
    }
    public function findByTorrent($torrent){
        return $this->createQueryBuilder('p')->where("p.fid = :torrent")->setParameter("torrent", $torrent)->orderBy('p.completed', 'ASC')->getQuery()->getResult();
    }
    public function getPeersCountByUser($user)
    {
        return [
            'seeders' => count($this->createQueryBuilder('p')->where("p.active = 1")->andWhere("p.remaining = 0")->andWhere("p.uid = :user")->setParameter('user', $user)->getQuery()->getResult()),
            'leechers' => count($this->createQueryBuilder('p')->where("p.active = 1")->andWhere("p.remaining > 0")->andWhere("p.uid = :user")->setParameter('user', $user)->getQuery()->getResult())
        ];
    }
    // /**
    //  * @return XbtFilesUsers[] Returns an array of XbtFilesUsers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?XbtFilesUsers
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
