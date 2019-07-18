<?php

namespace App\Repository;

use App\Entity\DureeModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DureeModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method DureeModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method DureeModule[]    findAll()
 * @method DureeModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DureeModuleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DureeModule::class);
    }

    // /**
    //  * @return DureeModule[] Returns an array of DureeModule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DureeModule
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
