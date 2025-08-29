<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;


    /**
     * @var Collection<int, MembreEquipe>
     */
    #[ORM\OneToMany(targetEntity: MembreEquipe::class, mappedBy: 'equipe')]
    private Collection $membreEquipes;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'equipe')]
    private Collection $projets;

    #[ORM\Column]
    private ?bool $disponible = null;

    public function __construct()
    {
        $this->membreEquipes = new ArrayCollection();
        $this->projets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, MembreEquipe>
     */
    public function getMembreEquipes(): Collection
    {
        return $this->membreEquipes;
    }

    public function addMembreEquipe(MembreEquipe $membreEquipe): static
    {
        if (!$this->membreEquipes->contains($membreEquipe)) {
            $this->membreEquipes->add($membreEquipe);
            $membreEquipe->setEquipe($this);
        }

        return $this;
    }

    public function removeMembreEquipe(MembreEquipe $membreEquipe): static
    {
        if ($this->membreEquipes->removeElement($membreEquipe)) {
            // set the owning side to null (unless already changed)
            if ($membreEquipe->getEquipe() === $this) {
                $membreEquipe->setEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setEquipe($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getEquipe() === $this) {
                $projet->setEquipe(null);
            }
        }

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): static
    {
        $this->disponible = $disponible;

        return $this;
    }
}
