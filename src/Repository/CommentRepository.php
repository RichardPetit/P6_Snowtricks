<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @return Comment[] Returns an array of Comment objects
     * @param int $id
     */

    public function getCommentsForArticle(int $id): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.active = 1')
            ->setParameter('id', $id)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function changeToActiveStatusForComment(int $id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id', $id )
//            ->andWhere('c.trick_id', $id)
            ->andWhere('c.active = 0')
            ->setParameter('c.active = 1')
            ;
    }
    public function changeToInactiveStatusForComment(int $id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id', $id )
            ->andWhere('c.active = 1')
            ->setParameter('c.active = 0')
            ;
    }


    // /**
    //  * @return Comment[] Returns an array of Comment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
