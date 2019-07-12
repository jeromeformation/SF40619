<?php

namespace App\Repository;

use App\Entity\Professionnel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Professionnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Professionnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Professionnel[]    findAll()
 * @method Professionnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionnelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Professionnel::class);
    }

    // /**
    //  * @return Professionnel[] Returns an array of Professionnel objects
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
    public function findOneBySomeField($value): ?Professionnel
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
