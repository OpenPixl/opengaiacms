<?php

namespace App\Repository\Webapp;

use App\Entity\Webapp\BlockType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlockType>
 *
 * @method BlockType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlockType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlockType[]    findAll()
 * @method BlockType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlockTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlockType::class);
    }

//    /**
//     * @return BlockType[] Returns an array of BlockType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BlockType
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
