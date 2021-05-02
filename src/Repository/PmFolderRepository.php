<?php

namespace App\Repository;

use App\Entity\PmFolder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PmFolder|null find($id, $lockMode = null, $lockVersion = null)
 * @method PmFolder|null findOneBy(array $criteria, array $orderBy = null)
 * @method PmFolder[]    findAll()
 * @method PmFolder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PmFolderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PmFolder::class);
    }

    // /**
    //  * @return PmFolder[] Returns an array of PmFolder objects
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
    public function findOneBySomeField($value): ?PmFolder
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
