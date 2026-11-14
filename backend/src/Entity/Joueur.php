<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull(message: "Le nom est obligatoire.")]
    #[ORM\Column(length: 80)]
    private ?string $nom_joueur = null;

    #[Assert\NotNull(message: "Le prénom est obligatoire.")]
    #[ORM\Column(length: 80)]
    private ?string $prenom_joueur = null;

    #[Assert\NotNull(message: "L'age est obligatoire.")]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $age = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $vitesse = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $endurance = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $force = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $technique = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column]
    private int $match_absence = 0;

    #[ORM\Column]
    private bool $blesse = false;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_blessure = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    private ?Equipe $equipe = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poste $poste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJoueur(): ?string
    {
        return $this->nom_joueur;
    }

    public function setNomJoueur(string $nom_joueur): static
    {
        $this->nom_joueur = $nom_joueur;

        return $this;
    }

    public function getPrenomJoueur(): ?string
    {
        return $this->prenom_joueur;
    }

    public function setPrenomJoueur(string $prenom_joueur): static
    {
        $this->prenom_joueur = $prenom_joueur;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getVitesse(): ?int
    {
        return $this->vitesse;
    }

    public function setVitesse(int $vitesse): static
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getEndurance(): ?int
    {
        return $this->endurance;
    }

    public function setEndurance(int $endurance): static
    {
        $this->endurance = $endurance;

        return $this;
    }

    public function getForce(): ?int
    {
        return $this->force;
    }

    public function setForce(int $force): static
    {
        $this->force = $force;

        return $this;
    }

    public function getTechnique(): ?int
    {
        return $this->technique;
    }

    public function setTechnique(int $technique): static
    {
        $this->technique = $technique;

        return $this;
    }

    public function getMatchAbsence(): int
    {
        return $this->match_absence;
    }

    public function setMatchAbsence(int $match_absence): static
    {
        $this->match_absence = $match_absence;

        return $this;
    }

    public function isBlesse(): ?bool
    {
        return $this->blesse;
    }

    public function setBlesse(bool $blesse): static
    {
        $this->blesse = $blesse;

        return $this;
    }

    public function getDateBlessure(): ?\DateTime
    {
        return $this->date_blessure;
    }

    public function setDateBlessure(?\DateTime $date_blessure): static
    {
        $this->date_blessure = $date_blessure;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): static
    {
        $this->equipe = $equipe;

        return $this;
    }

    public function getPoste(): ?Poste
    {
        return $this->poste;
    }

    public function setPoste(Poste $poste): static
    {
        $this->poste = $poste;

        return $this;
    }
}
