<?php

namespace App\Repository;

use App\Entity\IncomingDelivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IncomingDelivery|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncomingDelivery|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncomingDelivery[]    findAll()
 * @method IncomingDelivery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncomingProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncomingDelivery::class);
    }

    // /**
    //  * @return IncomingDeliveryController[] Returns an array of IncomingDeliveryController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IncomingDeliveryController
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
