<?php

namespace App\Repository;

use App\Entity\FairePartie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FairePartie>
 *
 * @method FairePartie|null find($id, $lockMode = null, $lockVersion = null)
 * @method FairePartie|null findOneBy(array $criteria, array $orderBy = null)
 * @method FairePartie[]    findAll()
 * @method FairePartie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FairePartieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FairePartie::class);
    }

//    /**
//     * @return FairePartie[] Returns an array of FairePartie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FairePartie
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
