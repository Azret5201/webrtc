<?php

namespace App\Repository;

use App\Entity\Raw;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Raw|null find($id, $lockMode = null, $lockVersion = null)
 * @method Raw|null findOneBy(array $criteria, array $orderBy = null)
 * @method Raw[]    findAll()
 * @method Raw[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RawRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Raw::class);
    }

    // /**
    //  * @return Raw[] Returns an array of Raw objects
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
    public function findOneBySomeField($value): ?Raw
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
