<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    private ?User $Employee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTime $heureArrive = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $heureDepart = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    private ?JourDeTravail $jourdetravail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?User
    {
        return $this->Employee;
    }

    public function setEmployee(?User $Employee): static
    {
        $this->Employee = $Employee;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

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

    public function getHeureArrive(): ?\DateTime
    {
        return $this->heureArrive;
    }

    public function setHeureArrive(\DateTime $heureArrive): static
    {
        $this->heureArrive = $heureArrive;

        return $this;
    }

    public function getHeureDepart(): ?\DateTime
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(?\DateTime $heureDepart): static
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getJourdetravail(): ?JourDeTravail
    {
        return $this->jourdetravail;
    }

    public function setJourdetravail(?JourDeTravail $jourdetravail): static
    {
        $this->jourdetravail = $jourdetravail;

        return $this;
    }
}
