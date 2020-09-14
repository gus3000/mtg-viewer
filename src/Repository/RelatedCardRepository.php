<?php

namespace App\Repository;

use App\Entity\RelatedCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelatedCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelatedCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelatedCard[]    findAll()
 * @method RelatedCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelatedCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelatedCard::class);
    }

    // /**
    //  * @return RelatedCard[] Returns an array of RelatedCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RelatedCard
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
