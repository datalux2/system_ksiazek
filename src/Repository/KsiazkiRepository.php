<?php

namespace App\Repository;

use App\Entity\Ksiazki;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ksiazki>
 *
 * @method Ksiazki|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ksiazki|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ksiazki[]    findAll()
 * @method Ksiazki[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KsiazkiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ksiazki::class);
    }
    
    public function getAllPagination(int $countRows, int $offset)
    {
        return $this->createQueryBuilder('k')
                ->setMaxResults($countRows)
                ->setFirstResult($offset)
                ->orderBy('k.id', 'desc')
                ->getQuery()
                ->getResult();
    }
    
    public function getCountAllRows()
    {
        return $this->createQueryBuilder('k')
                ->select('count(k.id)')
                ->getQuery()
                ->getSingleScalarResult();
    }

//    /**
//     * @return Ksiazki[] Returns an array of Ksiazki objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('k.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ksiazki
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
