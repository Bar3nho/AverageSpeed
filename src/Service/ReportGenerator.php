<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trip;
use App\Entity\TripMeasures;


class ReportGenerator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function generateReport(){
        $outputArray = ['headers'=>['trip','distance', 'measure interval', 'avg speed']];

        $trips = $this->entityManager->getRepository(Trip::class)->findAll();
        foreach($trips as $trip){
            $tripMeasures = $this->entityManager->getRepository(TripMeasures::class)->findBy(['trip'=>$trip->getId()]);
            $outputArray['values'][] = $this->calculate($tripMeasures, $trip);
        }

        return $outputArray;
    }

    public function calculate($tripMeasures, Trip $trip){
        $finalRow = [];
        $distance = $avg_speed = 0;
        $measureInterval = $trip->getMeasureInterval();

        if(count($tripMeasures) > 1){
            $speeds = [];
            for($i = 1; $i < count($tripMeasures); $i++){
                $speeds[] = (3600 * ($tripMeasures[$i]->getDistance() - $tripMeasures[$i-1]->getDistance()))/$measureInterval;
            }
            $avg_speed = floor(max($speeds));
            $distance = end($tripMeasures)->getDistance();
        }

        $finalRow[] = $trip->getName();
        $finalRow[] = $distance;
        $finalRow[] = $measureInterval;
        $finalRow[] = $avg_speed;
        return $finalRow;
    }
}