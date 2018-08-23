<?php

namespace App\Repository;

use App\Entity\WorkoutProgram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkoutProgram|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkoutProgram|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkoutProgram[]    findAll()
 * @method WorkoutProgram[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkoutProgramRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkoutProgram::class);
    }

//    /**
//     * @return WorkoutProgram[] Returns an array of WorkoutProgram objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkoutProgram
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
