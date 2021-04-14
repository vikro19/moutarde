<?php

namespace App\Repository;

use App\Entity\CommandeQuantite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeQuantite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeQuantite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeQuantite[]    findAll()
 * @method CommandeQuantite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeQuantiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeQuantite::class);
    }

    // /**
    //  * @return CommandeQuantite[] Returns an array of CommandeQuantite objects
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
    public function findOneBySomeField($value): ?CommandeQuantite
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
