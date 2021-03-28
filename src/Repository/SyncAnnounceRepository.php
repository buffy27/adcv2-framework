<?php

namespace App\Repository;

use App\Entity\SyncAnnounce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SyncAnnounce|null find($id, $lockMode = null, $lockVersion = null)
 * @method SyncAnnounce|null findOneBy(array $criteria, array $orderBy = null)
 * @method SyncAnnounce[]    findAll()
 * @method SyncAnnounce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyncAnnounceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SyncAnnounce::class);
    }

    public function findByTorrent($torrent)
    {
        return $this->createQueryBuilder('s')->where('s.torrent = :torrent')
            ->setParameter('torrent', $torrent)->setMaxResults(1)->getQuery()->getResult();
    }

    public function findByDataPasskey($passkey){
        return $this->createQueryBuilder('t')->where('t.data_passkey = :passkey')
            ->setParameter("passkey", $passkey)->setMaxResults(1)
            ->getQuery()->getResult();
    }


    // /**
    //  * @return SyncAnnounce[] Returns an array of SyncAnnounce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SyncAnnounce
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
