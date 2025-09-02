<?php

namespace App\Entity;

use App\Repository\TacheNormaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheNormaleRepository::class)]
class TacheNormale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAchevement = null;

    #[ORM\Column(length: 255, nullable:true )]
    private ?string $achevement = null;

    #[ORM\ManyToOne(inversedBy: 'tacheNormales')]
    private ?User $assigne = null;

    #[ORM\ManyToOne(inversedBy: 'tacheNormales')]
    private ?User $assignant = null;

    #[ORM\Column(length: 255)]
    private ?string $status = "en cours";

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getAssigne(): ?User
    {
        return $this->assigne;
    }

    public function setAssigne(?User $assigne): static
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
