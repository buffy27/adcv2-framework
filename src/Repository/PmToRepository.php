<?php

namespace App\Repository;

use App\Entity\PmBox;
use App\Entity\PmTo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PmTo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PmTo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PmTo[]    findAll()
 * @method PmTo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PmToRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PmTo::class);
    }

    public function findByReceiver(array $values){
        return $this->createQueryBuilder('pm_to')
            ->select('pm_to')
            ->join(PmBox::class, 'pm_box', Join::WITH, 'pm_to.message = pm_box')
            ->where('pm_to.receiver = :receiver')
            ->setParameter('receiver', $values['receiver'])
            ->andWhere('pm_to.folder = :folder')
            ->setParameter('folder',  $values['folder'])
            ->orderBy('pm_box.added', 'DESC')
            ->getQuery()->getResult();
    }

    // /**
    //  * @return PmTo[] Returns an array of PmTo objects
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
    public function findOneBySomeField($value): ?PmTo
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
