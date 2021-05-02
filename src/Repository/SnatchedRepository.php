<?php

namespace App\Repository;

use App\Entity\Snatched;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Snatched|null find($id, $lockMode = null, $lockVersion = null)
 * @method Snatched|null findOneBy(array $criteria, array $orderBy = null)
 * @method Snatched[]    findAll()
 * @method Snatched[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SnatchedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Snatched::class);
    }

    // /**
    //  * @return Snatched[] Returns an array of Snatched objects
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
    public function findOneBySomeField($value): ?Snatched
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
