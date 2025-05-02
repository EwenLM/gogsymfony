<?php

namespace App\Entity;

use App\Repository\ContributionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContributionRepository::class)]
class Contribution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?gear $gear = null;

    #[ORM\ManyToOne(inversedBy: 'contributions')]
    private ?music $music = null;

    #[ORM\ManyToOne(inversedBy: 'contributions')]
    private ?userU $userU = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getGear(): ?gear
    {
        return $this->gear;
    }

    public function setGear(?gear $gear): static
    {
        $this->gear = $gear;

        return $this;
    }

    public function getMusic(): ?music
    {
        return $this->music;
    }

    public function setMusic(?music $music): static
    {
        $this->music = $music;

        return $this;
    }

    public function getUserU(): ?userU
    {
        return $this->userU;
    }

    public function setUserU(?userU $userU): static
    {
        $this->userU = $userU;

        return $this;
    }
}
