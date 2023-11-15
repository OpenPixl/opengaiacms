<?php

namespace App\Repository\Webapp;

use App\Entity\Webapp\Pagechoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PageChoice>
 *
 * @method Pagechoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pagechoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pagechoice[]    findAll()
 * @method Pagechoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PagechoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageChoice::class);
    }

//    /**
//     * @return PageChoice[] Returns an array of PageChoice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PageChoice
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
