<?php

namespace App\Entity;

use App\Repository\MembreEquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreEquipeRepository::class)]
class MembreEquipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'membreEquipes')]
    private ?User $membre = null;

    #[ORM\ManyToOne(inversedBy: 'membreEquipes')]
    private ?Equipe $equipe = null;

    /**
     * @var Collection<int, TacheProjet>
     */
    #[ORM\OneToMany(targetEntity: TacheProjet::class, mappedBy: 'assigne')]
    private Collection $tacheProjets;

    public function __construct()
    {
        $this->tacheProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMembre(): ?User
    {
        return $this->membre;
    }

    public function setMembre(?User $membre): static
    {
        $this->membre = $membre;

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

    /**
     * @return Collection<int, TacheProjet>
     */
    public function getTacheProjets(): Collection
    {
        return $this->tacheProjets;
    }

    public function addTacheProjet(TacheProjet $tacheProjet): static
    {
        if (!$this->tacheProjets->contains($tacheProjet)) {
            $this->tacheProjets->add($tacheProjet);
            $tacheProjet->setAssigne($this);
        }

        return $this;
    }

    public function removeTacheProjet(TacheProjet $tacheProjet): static
    {
        if ($this->tacheProjets->removeElement($tacheProjet)) {
            // set the owning side to null (unless already changed)
            if ($tacheProjet->getAssigne() === $this) {
                $tacheProjet->setAssigne(null);
            }
        }

        return $this;
    }
}
