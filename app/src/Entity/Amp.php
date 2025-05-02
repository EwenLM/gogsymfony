<?php

namespace App\Entity;

use App\Repository\AmpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmpRepository::class)]
#[ORM\Table(name: 'amps', schema: 'gog')]

class Amp extends Gear
{
   
    #[ORM\Column]
    private ?int $power = null;

    #[ORM\Column(length: 255)]
    private ?string $technology = null;

 

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getTechnology(): ?string
    {
        return $this->technology;
    }

    public function setTechnology(string $technology): static
    {
        $this->technology = $technology;

        return $this;
    }

}
