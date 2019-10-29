<?php

namespace App\Repository;

use App\Entity\TripMeasures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TripMeasures|null find($id, $lockMode = null, $lockVersion = null)
 * @method TripMeasures|null findOneBy(array $criteria, array $orderBy = null)
 * @method TripMeasures[]    findAll()
 * @method TripMeasures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripMeasuresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripMeasures::class);
    }
}
