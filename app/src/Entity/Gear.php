<?php

namespace App\Entity;

use App\Repository\GearRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GearRepository::class)]
#[ORM\Table(name: 'gears', schema: 'gog')]
#[ORM\InheritanceType("SINGLE_TABLE")] // Type d'héritage
#[ORM\DiscriminatorColumn(name: "discr", type: "string")] // Colonne de discrimination
#[ORM\DiscriminatorMap([
    "gear" => Gear::class,
    "pedal" => Pedal::class,
    "amp" => Amp::class,
    "guitar" => Guitar::class
])] // Mapping des classes

class Gear
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }
}
