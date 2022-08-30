<?php

namespace App\Repository;

use App\Entity\InformationsOfRooms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationsOfRooms>
 *
 * @method InformationsOfRooms|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationsOfRooms|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationsOfRooms[]    findAll()
 * @method InformationsOfRooms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationsOfRoomsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationsOfRooms::class);
    }

    public function add(InformationsOfRooms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InformationsOfRooms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InformationsOfRooms[] Returns an array of InformationsOfRooms objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InformationsOfRooms
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
