<?php

namespace App\Entity;

use App\Repository\MatchEquipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchEquipeRepository::class)]
class MatchEquipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_match = null;

    #[ORM\Column]
    private ?int $score_domicile = null;

    #[ORM\Column]
    private ?int $score_exterieur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_creation = null;

    #[ORM\ManyToOne(inversedBy: 'matchs_domicile')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipe_domicile = null;

    #[ORM\ManyToOne(inversedBy: 'matchs_exterieurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipe_exterieure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMatch(): ?\DateTime
    {
        return $this->date_match;
    }

    public function setDateMatch(\DateTime $date_match): static
    {
        $this->date_match = $date_match;

        return $this;
    }

    public function getScoreDomicile(): ?int
    {
        return $this->score_domicile;
    }

    public function setScoreDomicile(int $score_domicile): static
    {
        $this->score_domicile = $score_domicile;

        return $this;
    }

    public function getScoreExterieur(): ?int
    {
        return $this->score_exterieur;
    }

    public function setScoreExterieur(int $score_exterieur): static
    {
        $this->score_exterieur = $score_exterieur;

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

    public function getEquipeDomicile(): ?Equipe
    {
        return $this->equipe_domicile;
    }

    public function setEquipeDomicile(?Equipe $equipe_domicile): static
    {
        $this->equipe_domicile = $equipe_domicile;

        return $this;
    }

    public function getEquipeExterieure(): ?Equipe
    {
        return $this->equipe_exterieure;
    }

    public function setEquipeExterieure(?Equipe $equipe_exterieure): static
    {
        $this->equipe_exterieure = $equipe_exterieure;

        return $this;
    }
}
