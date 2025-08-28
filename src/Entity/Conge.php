<?php

namespace App\Entity;

use App\Repository\CongeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CongeRepository::class)]
class Conge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbr_jour_conge = null;

    #[ORM\ManyToOne(inversedBy: 'conges')]
    private ?Employee $employee = null;

    #[ORM\Column]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;

    #[ORM\Column]
    private ?bool $valide = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?bool $validationRH = null;

    #[ORM\Column]
    private ?bool $validationManager = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrJourConge(): ?int
    {
        return $this->nbr_jour_conge;
    }

    public function setNbrJourConge(int $nbr_jour_conge): static
    {
        $this->nbr_jour_conge = $nbr_jour_conge;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

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

    public function isValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): static
    {
        $this->valide = $valide;

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

    public function isValidationRH(): ?bool
    {
        return $this->validationRH;
    }

    public function setValidationRH(bool $validationRH): static
    {
        $this->validationRH = $validationRH;

        return $this;
    }

    public function isValidationManager(): ?bool
    {
        return $this->validationManager;
    }

    public function setValidationManager(bool $validationManager): static
    {
        $this->validationManager = $validationManager;

        return $this;
    }
}
