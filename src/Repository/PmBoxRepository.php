<?php

namespace App\Repository;

use App\Entity\PmBox;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PmBox|null find($id, $lockMode = null, $lockVersion = null)
 * @method PmBox|null findOneBy(array $criteria, array $orderBy = null)
 * @method PmBox[]    findAll()
 * @method PmBox[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PmBoxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PmBox::class);
    }

    // /**
    //  * @return PmBox[] Returns an array of PmBox objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PmBox
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
