<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class TricksRepository extends ServiceEntityRepository
{
    public const NB_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }


    public function getTricksByAlpha()
    {

        return $this->createQueryBuilder('t')
            ->orderBy('t.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function getTricksByCreationDate(int $page = 1 , int $nbResults = self::NB_PER_PAGE)
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

    public function getTotalNumberOfTricks() : int
    {
        return $this->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()->getSingleScalarResult();
    }

    public function getNbOfPages() : int
    {
        $totalCount = $this->getTotalNumberOfTricks();
        if ($totalCount <= self::NB_PER_PAGE) {
            return 1;
        }
        return $totalCount % self::NB_PER_PAGE === 0 ? $totalCount / self::NB_PER_PAGE : ceil($totalCount / self::NB_PER_PAGE);
    }

    /*
    public function findOneBySomeField($value): ?Trick
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
