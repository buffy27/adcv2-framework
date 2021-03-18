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

    /**
     * @return TorrentsCategory[] Returns an array of Countries name
     */

    public function findAllNames()
    {
        $categories = $this->createQueryBuilder('c')
            ->getQuery()
            ->getArrayResult();
        $data = [];
        foreach ($categories as $category){
            $data[$category['name']] = $category['id'];
        }
        return  $data;
    }

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
