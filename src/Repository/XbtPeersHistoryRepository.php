<?php

namespace App\Repository;

use App\Entity\XbtPeersHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XbtPeersHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method XbtPeersHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method XbtPeersHistory[]    findAll()
 * @method XbtPeersHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XbtPeersHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XbtPeersHistory::class);
    }

    // /**
    //  * @return XbtPeersHistory[] Returns an array of XbtPeersHistory objects
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
    public function findOneBySomeField($value): ?XbtPeersHistory
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
