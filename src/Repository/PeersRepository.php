<?php

namespace App\Repository;

use App\Entity\Peers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Peers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peers[]    findAll()
 * @method Peers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peers::class);
    }

    public function findByAnnounce($user, $torrent, $peer_id){
        return $this->createQueryBuilder('p')->setMaxResults(1)
            ->where('p.user = :user')->andWhere('p.torrent = :torrent')->andWhere('p.peerId = :pid')
            ->setParameter("torrent", $torrent)
            ->setParameter("user", $user)
            ->setParameter("pid", $peer_id)
            ->getQuery()->getOneOrNullResult();
    }
    public function getAllPeers($queries, $torrent){
        return $this->createQueryBuilder('p')->setMaxResults($queries['numwant'])
            ->where('p.torrent = :torrent')->andWhere('p.peerId != :pid')
            ->setParameter('torrent', $torrent)->setParameter('pid', $queries['peer_id'])->getQuery()->getResult();
    }

    // /**
    //  * @return Peers[] Returns an array of Peers objects
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
    public function findOneBySomeField($value): ?Peers
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
