<?php

namespace App\Repository;

use App\Entity\Personnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Personnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnage[]    findAll()
 * @method Personnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class todoPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personnage::class);
    }

    /**
     * SELECT * FROM personnage AS p
     * @param array $liens
     * @return array|null
     */
    public function findAllByLiens(array $liens): ?array
    {
       /* $query = $this->createQueryBuilder('p')
            ->select('p.id')
            ->join('p.liens', 'l');

        $tabIds = [];

        foreach ($liens as $lien) {
            $tabIds[] = $query->where('l.id = :lien')
                ->setParameter('lien', $lien)
                ->getQuery()
                ->getArrayResult();
        }

        foreach ($tabIds as $key => $ids) {
            if($key !== 0) {
                foreach ($ids as $id) {
                    if (in_array($id['id'], $tabIds[$key-1]) {

                    }
                }
            }
        }
        dd($ids);*/
    }

    // /**
    //  * @return Personnage[] Returns an array of Personnage objects
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
    public function findOneBySomeField($value): ?Personnage
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
