<?php

namespace App\Entity;

use App\Repository\PosteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PosteRepository::class)]
class Poste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nom_poste = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_poste = null;

    #[ORM\Column]
    private int $min_vitesse = 0;

    #[ORM\Column]
    private int $min_endurance = 0;

    #[ORM\Column]
    private int $min_force = 0;

    #[ORM\Column]
    private int $min_technique = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPoste(): ?string
    {
        return $this->nom_poste;
    }

    public function setNomPoste(string $nom_poste): static
    {
        $this->nom_poste = $nom_poste;

        return $this;
    }

    public function getDescriptionPoste(): ?string
    {
        return $this->description_poste;
    }

    public function setDescriptionPoste(string $description_poste): static
    {
        $this->description_poste = $description_poste;

        return $this;
    }

    public function getMinVitesse(): ?int
    {
        return $this->min_vitesse;
    }

    public function setMinVitesse(int $min_vitesse): static
    {
        $this->min_vitesse = $min_vitesse;

        return $this;
    }

    public function getMinEndurance(): ?int
    {
        return $this->min_endurance;
    }

    public function setMinEndurance(int $min_endurance): static
    {
        $this->min_endurance = $min_endurance;

        return $this;
    }

    public function getMinForce(): ?int
    {
        return $this->min_force;
    }

    public function setMinForce(int $min_force): static
    {
        $this->min_force = $min_force;

        return $this;
    }

    public function getMinTechnique(): ?int
    {
        return $this->min_technique;
    }

    public function setMinTechnique(int $min_technique): static
    {
        $this->min_technique = $min_technique;

        return $this;
    }
}
