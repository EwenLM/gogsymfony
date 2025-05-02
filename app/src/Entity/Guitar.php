<?php

namespace App\Entity;

use App\Repository\GuitarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuitarRepository::class)]
#[ORM\Table(name: 'guitars', schema: 'gog')]

class Guitar extends Gear
{


    #[ORM\Column]
    private ?int $year = null;

  

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }
}
