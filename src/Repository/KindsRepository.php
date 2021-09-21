<?php

namespace App\Repository;

use App\Entity\Kinds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kinds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kinds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kinds[]    findAll()
 * @method Kinds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KindsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kinds::class);
    }

    // /**
    //  * @return Kinds[] Returns an array of Kinds objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kinds
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
