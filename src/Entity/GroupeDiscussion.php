<?php

namespace App\Entity;

use App\Repository\GroupeDiscussionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeDiscussionRepository::class)]
class GroupeDiscussion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, MembreGroupe>
     */
    #[ORM\OneToMany(targetEntity: MembreGroupe::class, mappedBy: 'groupe')]
    private Collection $membreGroupes;

    /**
     * @var Collection<int, MessageGroupe>
     */
    #[ORM\OneToMany(targetEntity: MessageGroupe::class, mappedBy: 'groupe')]
    private Collection $messageGroupes;

    public function __construct()
    {
        $this->membreGroupes = new ArrayCollection();
        $this->messageGroupes = new ArrayCollection();
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
     * @return Collection<int, MembreGroupe>
     */
    public function getMembreGroupes(): Collection
    {
        return $this->membreGroupes;
    }

    public function addMembreGroupe(MembreGroupe $membreGroupe): static
    {
        if (!$this->membreGroupes->contains($membreGroupe)) {
            $this->membreGroupes->add($membreGroupe);
            $membreGroupe->setGroupe($this);
        }

        return $this;
    }

    public function removeMembreGroupe(MembreGroupe $membreGroupe): static
    {
        if ($this->membreGroupes->removeElement($membreGroupe)) {
            // set the owning side to null (unless already changed)
            if ($membreGroupe->getGroupe() === $this) {
                $membreGroupe->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MessageGroupe>
     */
    public function getMessageGroupes(): Collection
    {
        return $this->messageGroupes;
    }

    public function addMessageGroupe(MessageGroupe $messageGroupe): static
    {
        if (!$this->messageGroupes->contains($messageGroupe)) {
            $this->messageGroupes->add($messageGroupe);
            $messageGroupe->setGroupe($this);
        }

        return $this;
    }

    public function removeMessageGroupe(MessageGroupe $messageGroupe): static
    {
        if ($this->messageGroupes->removeElement($messageGroupe)) {
            // set the owning side to null (unless already changed)
            if ($messageGroupe->getGroupe() === $this) {
                $messageGroupe->setGroupe(null);
            }
        }

        return $this;
    }
}
