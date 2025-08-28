<?php

namespace App\Entity;

use App\Repository\CommentaireDemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireDemandeRepository::class)]
class CommentaireDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireDemandes')]
    private ?User $auteur = null;

    #[ORM\ManyToOne(inversedBy: 'commentaireDemandes')]
    private ?DemandeInterne $demande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDemande(): ?DemandeInterne
    {
        return $this->demande;
    }

    public function setDemande(?DemandeInterne $demande): static
    {
        $this->demande = $demande;

        return $this;
    }
}
