<?php

namespace App\Entity;

use App\Repository\PedalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedalRepository::class)]
#[ORM\Table(name: 'pedals', schema: 'gog')]

class Pedal extends Gear
{


    #[ORM\Column(length: 255)]
    private ?string $effect = null;



    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(string $effect): static
    {
        $this->effect = $effect;

        return $this;
    }
}
