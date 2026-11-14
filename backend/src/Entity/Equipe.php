<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_equipe = null;

    #[ORM\Column(length: 80)]
    private ?string $coach = null;

    #[ORM\Column]
    private int $nb_victoires = 0;

    #[ORM\Column]
    private int $nb_defaites = 0;

    #[ORM\Column]
    private int $nb_matchs = 0;

    #[ORM\Column]
    private ?int $niveau_global = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_creation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nom_equipe;
    }

    public function setNomEquipe(string $nom_equipe): static
    {
        $this->nom_equipe = $nom_equipe;

        return $this;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(string $coach): static
    {
        $this->coach = $coach;

        return $this;
    }

    public function getNbVictoires(): ?int
    {
        return $this->nb_victoires;
    }

    public function setNbVictoires(int $nb_victoires): static
    {
        $this->nb_victoires = $nb_victoires;

        return $this;
    }

    public function getNbDefaites(): ?int
    {
        return $this->nb_defaites;
    }

    public function setNbDefaites(int $nb_defaites): static
    {
        $this->nb_defaites = $nb_defaites;

        return $this;
    }

    public function getNbMatchs(): ?int
    {
        return $this->nb_matchs;
    }

    public function setNbMatchs(int $nb_matchs): static
    {
        $this->nb_matchs = $nb_matchs;

        return $this;
    }

    public function getNiveauGlobal(): ?int
    {
        return $this->niveau_global;
    }

    public function setNiveauGlobal(int $niveau_global): static
    {
        $this->niveau_global = $niveau_global;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTime $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }
}
