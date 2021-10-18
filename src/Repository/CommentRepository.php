<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Trick;
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
    public const NB_PER_PAGE = 10;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @return Comment[] Returns an array of Comment objects
     * @param int $id
     */

    public function getCommentsForArticleByCreationDate(int $trickId, int $page = 1, int $nmResults = self::NB_PER_PAGE): ?array
    {
        $offset = ($page -1) * $nmResults;
        return $this->createQueryBuilder('c')
            ->where('c.trick = :trickId')
            ->setParameter('trickId', $trickId)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->setMaxResults($nmResults)
            ->setFirstResult($offset)
            ->getResult()
            ;
    }

    public function getTotalNumberOfCommentsForATrick(Trick $trick) : int
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.trick = :trickId')
            ->setParameter('trickId', $trick->getId())
            ->getQuery()->getSingleScalarResult();
    }

    public function getNbOfPages(Trick $trick) : int
    {
        $totalCount = $this->getTotalNumberOfCommentsForATrick($trick);
        if ($totalCount <= self::NB_PER_PAGE) {
            return 1;
        }
        return $totalCount % self::NB_PER_PAGE === 0 ? $totalCount / self::NB_PER_PAGE : ceil($totalCount / self::NB_PER_PAGE);
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
