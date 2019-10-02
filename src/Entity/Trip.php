<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 * @ORM\Table(name="trips")
 */
class Trip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Column(name="measure_interval")
     */
    private $measureInterval;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TripMeasures", mappedBy="trip")
     */
    private $tripMeasures;

    public function __construct()
    {
        $this->tripMeasures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMeasureInterval(): ?int
    {
        return $this->measureInterval;
    }

    public function setMeasureInterval(int $measureInterval): self
    {
        $this->measureInterval = $measureInterval;

        return $this;
    }

    /**
     * @return Collection|TripMeasures[]
     */
    public function getTripMeasures(): Collection
    {
        return $this->tripMeasures;
    }

    public function addTripMeasure(TripMeasures $tripMeasure): self
    {
        if (!$this->tripMeasures->contains($tripMeasure)) {
            $this->tripMeasures[] = $tripMeasure;
            $tripMeasure->setTrip($this);
        }

        return $this;
    }

    public function removeTripMeasure(TripMeasures $tripMeasure): self
    {
        if ($this->tripMeasures->contains($tripMeasure)) {
            $this->tripMeasures->removeElement($tripMeasure);
            // set the owning side to null (unless already changed)
            if ($tripMeasure->getTrip() === $this) {
                $tripMeasure->setTrip(null);
            }
        }

        return $this;
    }
}
