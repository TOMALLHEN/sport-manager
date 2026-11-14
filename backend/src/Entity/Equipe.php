<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Le nom de l'équipe est obligatoire.")]
    #[ORM\Column(length: 255)]
    private ?string $nom_equipe = null;

    #[Assert\NotBlank(message: "Un coach est obligatoire.")]
    #[ORM\Column(length: 80)]
    private ?string $coach = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column]
    private int $nb_victoires = 0;

    #[Assert\PositiveOrZero]
    #[ORM\Column]
    private int $nb_defaites = 0;

    #[Assert\PositiveOrZero]
    #[ORM\Column]
    private int $nb_matchs = 0;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    private ?int $niveau_global = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_creation = null;

    /**
     * @var Collection<int, Joueur>
     */
    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'equipe')]
    private Collection $joueurs;

    /**
     * @var Collection<int, MatchEquipe>
     */
    #[ORM\OneToMany(targetEntity: MatchEquipe::class, mappedBy: 'equipe_domicile')]
    private Collection $matchs_domicile;

    /**
     * @var Collection<int, MatchEquipe>
     */
    #[ORM\OneToMany(targetEntity: MatchEquipe::class, mappedBy: 'equipe_exterieure')]
    private Collection $matchs_exterieurs;

    public function __construct()
    {
        $this->date_creation = new \DateTime();

        $this->joueurs = new ArrayCollection();
        $this->matchs_domicile = new ArrayCollection();
        $this->matchs_exterieurs = new ArrayCollection();
    }

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

    public function getNbVictoires(): int
    {
        return $this->nb_victoires;
    }

    public function setNbVictoires(int $nb_victoires): static
    {
        $this->nb_victoires = $nb_victoires;

        return $this;
    }

    public function getNbDefaites(): int
    {
        return $this->nb_defaites;
    }

    public function setNbDefaites(int $nb_defaites): static
    {
        $this->nb_defaites = $nb_defaites;

        return $this;
    }

    public function getNbMatchs(): int
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

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->setEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getEquipe() === $this) {
                $joueur->setEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MatchEquipe>
     */
    public function getMatchsDomicile(): Collection
    {
        return $this->matchs_domicile;
    }

    public function addMatchsDomicile(MatchEquipe $matchsDomicile): static
    {
        if (!$this->matchs_domicile->contains($matchsDomicile)) {
            $this->matchs_domicile->add($matchsDomicile);
            $matchsDomicile->setEquipeDomicile($this);
        }

        return $this;
    }

    public function removeMatchsDomicile(MatchEquipe $matchsDomicile): static
    {
        if ($this->matchs_domicile->removeElement($matchsDomicile)) {
        }

        return $this;
    }

    /**
     * @return Collection<int, MatchEquipe>
     */
    public function getMatchsExterieurs(): Collection
    {
        return $this->matchs_exterieurs;
    }

    public function addMatchsExterieur(MatchEquipe $matchsExterieur): static
    {
        if (!$this->matchs_exterieurs->contains($matchsExterieur)) {
            $this->matchs_exterieurs->add($matchsExterieur);
            $matchsExterieur->setEquipeExterieure($this);
        }

        return $this;
    }

    public function removeMatchsExterieur(MatchEquipe $matchsExterieur): static
    {
        if ($this->matchs_exterieurs->removeElement($matchsExterieur)) {
        }

        return $this;
    }
}
