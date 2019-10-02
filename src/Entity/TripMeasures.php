<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripMeasuresRepository")
 * @ORM\Table(name="trip_measures")
 */
class TripMeasures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trip", inversedBy="tripMeasures")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(type="integer",name="trip_id")
     */
    private $trip;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $distance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): self
    {
        $this->trip = $trip;

        return $this;
    }

    public function getDistance(): ?string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): self
    {
        $this->distance = $distance;

        return $this;
    }
}
