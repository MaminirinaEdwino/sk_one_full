<?php

namespace App\Entity;

use App\Repository\TacheProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheProjetRepository::class)]
class TacheProjet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $snom = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'tacheProjets')]
    private ?MembreEquipe $assigne = null;

    #[ORM\ManyToOne(inversedBy: 'tacheProjets')]
    private ?User $assignant = null;

    #[ORM\Column]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAchevement = null;

    #[ORM\Column(length: 255)]
    private ?string $achevement = null;

    #[ORM\ManyToOne(inversedBy: 'tacheProjets')]
    private ?Projet $projet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSnom(): ?string
    {
        return $this->snom;
    }

    public function setSnom(string $snom): static
    {
        $this->snom = $snom;

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

    public function getAssigne(): ?MembreEquipe
    {
        return $this->assigne;
    }

    public function setAssigne(?MembreEquipe $assigne): static
    {
        $this->assigne = $assigne;

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

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateAchevement(): ?\DateTime
    {
        return $this->dateAchevement;
    }

    public function setDateAchevement(?\DateTime $dateAchevement): static
    {
        $this->dateAchevement = $dateAchevement;

        return $this;
    }

    public function getAchevement(): ?string
    {
        return $this->achevement;
    }

    public function setAchevement(string $achevement): static
    {
        $this->achevement = $achevement;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }
}
