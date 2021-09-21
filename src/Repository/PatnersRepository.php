<?php

namespace App\Repository;

use App\Entity\Patners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Patners|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patners|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patners[]    findAll()
 * @method Patners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatnersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patners::class);
    }

    // /**
    //  * @return Patners[] Returns an array of Patners objects
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
    public function findOneBySomeField($value): ?Patners
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
