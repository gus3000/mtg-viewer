<?php

namespace App\Repository;

use App\Entity\CardFace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CardFace|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardFace|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardFace[]    findAll()
 * @method CardFace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardFaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardFace::class);
    }

    // /**
    //  * @return CardFace[] Returns an array of CardFace objects
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
    public function findOneBySomeField($value): ?CardFace
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
