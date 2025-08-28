<?php

namespace App\Entity;

use App\Repository\CategorieFonctionnelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieFonctionnelleRepository::class)]
class CategorieFonctionnelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, DemandeInterne>
     */
    #[ORM\OneToMany(targetEntity: DemandeInterne::class, mappedBy: 'categorie')]
    private Collection $demandeInternes;

    public function __construct()
    {
        $this->demandeInternes = new ArrayCollection();
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
     * @return Collection<int, DemandeInterne>
     */
    public function getDemandeInternes(): Collection
    {
        return $this->demandeInternes;
    }

    public function addDemandeInterne(DemandeInterne $demandeInterne): static
    {
        if (!$this->demandeInternes->contains($demandeInterne)) {
            $this->demandeInternes->add($demandeInterne);
            $demandeInterne->setCategorie($this);
        }

        return $this;
    }

    public function removeDemandeInterne(DemandeInterne $demandeInterne): static
    {
        if ($this->demandeInternes->removeElement($demandeInterne)) {
            // set the owning side to null (unless already changed)
            if ($demandeInterne->getCategorie() === $this) {
                $demandeInterne->setCategorie(null);
            }
        }

        return $this;
    }
}
