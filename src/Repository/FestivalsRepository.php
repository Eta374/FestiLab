<?php

namespace App\Repository;

use App\Entity\Festivals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Festivals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Festivals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Festivals[]    findAll()
 * @method Festivals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FestivalsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Festivals::class);
    }

    // /**
    //  * @return Festivals[] Returns an array of Festivals objects
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
    public function findOneBySomeField($value): ?Festivals
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
