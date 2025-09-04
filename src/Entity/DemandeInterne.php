<?php

namespace App\Entity;

use App\Repository\DemandeInterneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeInterneRepository::class)]
class DemandeInterne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'demandeInternes')]
    private ?CategorieFonctionnelle $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\Column]
    private ?\DateTime $dateEnvoi = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateModif = null;

    #[ORM\ManyToOne(inversedBy: 'demandeInternes')]
    private ?User $auteur = null;

    /**
     * @var Collection<int, CommentaireDemande>
     */
    #[ORM\OneToMany(targetEntity: CommentaireDemande::class, mappedBy: 'demande')]
    private Collection $commentaireDemandes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'demandeInterneTraite')]
    private ?User $responsable = null;

    public function __construct()
    {
        $this->commentaireDemandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getCategorie(): ?CategorieFonctionnelle
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieFonctionnelle $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTime
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTime $dateEnvoi): static
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getDateModif(): ?\DateTime
    {
        return $this->dateModif;
    }

    public function setDateModif(?\DateTime $dateModif): static
    {
        $this->dateModif = $dateModif;

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

    /**
     * @return Collection<int, CommentaireDemande>
     */
    public function getCommentaireDemandes(): Collection
    {
        return $this->commentaireDemandes;
    }

    public function addCommentaireDemande(CommentaireDemande $commentaireDemande): static
    {
        if (!$this->commentaireDemandes->contains($commentaireDemande)) {
            $this->commentaireDemandes->add($commentaireDemande);
            $commentaireDemande->setDemande($this);
        }

        return $this;
    }

    public function removeCommentaireDemande(CommentaireDemande $commentaireDemande): static
    {
        if ($this->commentaireDemandes->removeElement($commentaireDemande)) {
            // set the owning side to null (unless already changed)
            if ($commentaireDemande->getDemande() === $this) {
                $commentaireDemande->setDemande(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

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
}
