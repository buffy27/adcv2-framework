<?php

namespace App\Repository;

use App\Entity\TorrentComments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TorrentComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method TorrentComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method TorrentComments[]    findAll()
 * @method TorrentComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TorrentCommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TorrentComments::class);
    }

    // /**
    //  * @return TorrentComments[] Returns an array of TorrentComments objects
    //  */

    public function findByTorrentId($value)
    {
        return $this->createQueryBuilder('t')
            ->where('t.torrents = :val')
            ->setParameter('val', $value)
            ->orderBy('t.added', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?TorrentComments
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
