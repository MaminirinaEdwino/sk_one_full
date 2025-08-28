<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?User $responsable = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    private ?Equipe $equipe = null;

    #[ORM\Column(length: 255)]
    private ?string $status_achevement = null;

    #[ORM\ManyToOne(inversedBy: 'projetAssigne')]
    private ?User $assignant = null;

    #[ORM\Column]
    private ?bool $archive = null;

    #[ORM\Column]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, TacheProjet>
     */
    #[ORM\OneToMany(targetEntity: TacheProjet::class, mappedBy: 'projet')]
    private Collection $tacheProjets;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function __construct()
    {
        $this->tacheProjets = new ArrayCollection();
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

    public function getResponsable(): ?User
    {
        return $this->responsable;
    }

    public function setResponsable(?User $responsable): static
    {
        $this->responsable = $responsable;

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

    public function getStatusAchevement(): ?string
    {
        return $this->status_achevement;
    }

    public function setStatusAchevement(string $status_achevement): static
    {
        $this->status_achevement = $status_achevement;

        return $this;
    }

    public function getAssignant(): ?User
    {
        return $this->assignant;
    }

    public function setAssignant(?User $assignant): static
    {
        $this->assignant = $assignant;

        return $this;
    }

    public function isArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): static
    {
        $this->archive = $archive;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $tacheProjet->setProjet($this);
        }

        return $this;
    }

    public function removeTacheProjet(TacheProjet $tacheProjet): static
    {
        if ($this->tacheProjets->removeElement($tacheProjet)) {
            // set the owning side to null (unless already changed)
            if ($tacheProjet->getProjet() === $this) {
                $tacheProjet->setProjet(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
