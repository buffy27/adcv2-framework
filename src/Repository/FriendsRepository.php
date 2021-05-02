<?php

namespace App\Repository;

use App\Entity\Friends;
use App\Entity\UserClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Friends|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friends|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friends[]    findAll()
 * @method Friends[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Friends::class);
    }

    public function findByUser($user){
        return $this->createQueryBuilder('f')
            ->where('f.user = :user OR f.friend = :user')
            ->setParameter('user', $user)->getQuery()->getResult();
    }

    public function findFriendRelation($u1, $u2){
        return $this->createQueryBuilder('f')
            ->where('f.user = :u1 OR f.friend = :u2')
            ->orWhere('f.user = :u2 OR f.friend = :u1')
            ->setParameter('u1', $u1)
            ->setParameter('u2', $u2)->getQuery()->getOneOrNullResult();
    }
    // /**
    //  * @return Friends[] Returns an array of Friends objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Friends
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
