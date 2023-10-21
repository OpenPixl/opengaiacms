<?php

namespace App\Repository\Admin;

use App\Entity\Admin\UnderConstruction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UnderConstruction>
 *
 * @method UnderConstruction|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnderConstruction|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnderConstruction[]    findAll()
 * @method UnderConstruction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnderConstructionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnderConstruction::class);
    }

    Public function findFirstReccurence(){
        return $this->createQueryBuilder('a')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//    /**
//     * @return UnderConstruction[] Returns an array of UnderConstruction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UnderConstruction
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
