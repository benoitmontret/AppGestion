<?php

namespace App\Repository;

use App\Entity\AvoirNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvoirNote>
 *
 * @method AvoirNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvoirNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvoirNote[]    findAll()
 * @method AvoirNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvoirNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvoirNote::class);
    }

//    /**
//     * @return AvoirNote[] Returns an array of AvoirNote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AvoirNote
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
