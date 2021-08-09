<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tricks[]    findAll()
 * @method Tricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tricks::class);
    }


    public function getTricksByAlpha()
    {

        return $this->createQueryBuilder('t')
            ->orderBy('t.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function getTricksByCreationDate(int $page = 1 , int $nbResults = 10)
    {
        $offset = ($page -1) * $nbResults;
        return $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->setMaxResults($nbResults)
            ->setFirstResult($offset)
            ->getResult()
        ;
    }

    public function countByCreationDate()
    {
//        $query = $this->createQueryBuilder('t')
//            ->select('substring(tricks.created_at, 1, 10) as trickDate, COUNT(tricks.id)
//            as count from tricks group by created_at' )
//            ->groupBy('trickDate')
//            ;
//        return $query->getQuery()->getResult();

    }

    /*
    public function findOneBySomeField($value): ?Tricks
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
