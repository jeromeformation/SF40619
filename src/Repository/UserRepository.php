<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Liste les différents mails des utilisateurs
     * @return array
     */
    public function findAllEmails(): array
    {
        $userEmails = $this->createQueryBuilder('u')
            ->select('u.email')

            ->getQuery()
            ->getResult()
        ;

        $mails = [];
        foreach ($userEmails as $userEmail) {
            $mails[] = $userEmail['email'];
        }
        return $mails;
    }

    /**
     * SELECT * FROM app_user AS u
     * @param string $role
     * @return array|null
     */
    public function findAllByRole(string $role): ?array
    {
        $results = $this->createQueryBuilder('u')
            ->where("JSON_SEARCH(u.roles, 'one', :role, '\', '$') IS NOT NULL")
            ->setParameter('role', $role)
            ->getQuery()
            ->getResult();

        dump($results);
        return $results;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
