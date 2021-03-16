<?php

namespace App\Repository;

use App\Entity\TorrentsCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TorrentsCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method TorrentsCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method TorrentsCategory[]    findAll()
 * @method TorrentsCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorrentsCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorrentsCategory::class);
    }

    // /**
    //  * @return TorrentsCategory[] Returns an array of TorrentsCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TorrentsCategory
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
