<?php

namespace App\Entity;

use App\Repository\MessageGroupeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageGroupeRepository::class)]
class MessageGroupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'messageGroupes')]
    private ?MembreGroupe $auteur = null;

    #[ORM\ManyToOne(inversedBy: 'messageGroupes')]
    private ?GroupeDiscussion $groupe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getAuteur(): ?MembreGroupe
    {
        return $this->auteur;
    }

    public function setAuteur(?MembreGroupe $auteur): static
    {
        $this->auteur = $auteur;

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
}
