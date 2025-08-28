<?php

namespace App\Entity;

use App\Repository\MembreGroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreGroupeRepository::class)]
class MembreGroupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'membreGroupes')]
    private ?User $membre = null;

    #[ORM\ManyToOne(inversedBy: 'membreGroupes')]
    private ?GroupeDiscussion $groupe = null;

    /**
     * @var Collection<int, MessageGroupe>
     */
    #[ORM\OneToMany(targetEntity: MessageGroupe::class, mappedBy: 'auteur')]
    private Collection $messageGroupes;

    public function __construct()
    {
        $this->messageGroupes = new ArrayCollection();
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

    public function getGroupe(): ?GroupeDiscussion
    {
        return $this->groupe;
    }

    public function setGroupe(?GroupeDiscussion $groupe): static
    {
        $this->groupe = $groupe;

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
            $messageGroupe->setAuteur($this);
        }

        return $this;
    }

    public function removeMessageGroupe(MessageGroupe $messageGroupe): static
    {
        if ($this->messageGroupes->removeElement($messageGroupe)) {
            // set the owning side to null (unless already changed)
            if ($messageGroupe->getAuteur() === $this) {
                $messageGroupe->setAuteur(null);
            }
        }

        return $this;
    }
}
