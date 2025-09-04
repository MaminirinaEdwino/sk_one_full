<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;



    #[ORM\OneToOne(inversedBy: 'user_accout', cascade: ['persist', 'remove'])]
    private ?Employee $employee = null;

    /**
     * @var Collection<int, DemandeInterne>
     */
    #[ORM\OneToMany(targetEntity: DemandeInterne::class, mappedBy: 'auteur')]
    private Collection $demandeInternes;

    /**
     * @var Collection<int, CommentaireDemande>
     */
    #[ORM\OneToMany(targetEntity: CommentaireDemande::class, mappedBy: 'auteur')]
    private Collection $commentaireDemandes;

    /**
     * @var Collection<int, Presence>
     */
    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'Employee')]
    private Collection $presences;

    /**
     * @var Collection<int, Notification>
     */
    #[ORM\OneToMany(targetEntity: Notification::class, mappedBy: 'auteur')]
    private Collection $notifications;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'responsable')]
    private Collection $projets;

    /**
     * @var Collection<int, MembreEquipe>
     */
    #[ORM\OneToMany(targetEntity: MembreEquipe::class, mappedBy: 'membre')]
    private Collection $membreEquipes;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'assignant')]
    private Collection $projetAssigne;

    /**
     * @var Collection<int, TacheProjet>
     */
    #[ORM\OneToMany(targetEntity: TacheProjet::class, mappedBy: 'assignant')]
    private Collection $tacheProjets;

    /**
     * @var Collection<int, TacheNormale>
     */
    #[ORM\OneToMany(targetEntity: TacheNormale::class, mappedBy: 'assigne')]
    private Collection $tacheNormales;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'envoyeur')]
    private Collection $messages;

    /**
     * @var Collection<int, MembreGroupe>
     */
    #[ORM\OneToMany(targetEntity: MembreGroupe::class, mappedBy: 'membre')]
    private Collection $membreGroupes;

    /**
     * @var Collection<int, DemandeInterne>
     */
    #[ORM\OneToMany(targetEntity: DemandeInterne::class, mappedBy: 'responsable')]
    private Collection $demandeInterneTraite;

    public function __construct()
    {
        $this->ManagerBus = new ArrayCollection();
        $this->EmployeesManager = new ArrayCollection();
        $this->demandeInternes = new ArrayCollection();
        $this->commentaireDemandes = new ArrayCollection();
        $this->presences = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->membreEquipes = new ArrayCollection();
        $this->projetAssigne = new ArrayCollection();
        $this->tacheProjets = new ArrayCollection();
        $this->tacheNormales = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->membreGroupes = new ArrayCollection();
        $this->demandeInterneTraite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
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

    /**
     * @return Collection<int, DemandeInterne>
     */
    public function getDemandeInternes(): Collection
    {
        return $this->demandeInternes;
    }

    public function addDemandeInterne(DemandeInterne $demandeInterne): static
    {
        if (!$this->demandeInternes->contains($demandeInterne)) {
            $this->demandeInternes->add($demandeInterne);
            $demandeInterne->setAuteur($this);
        }

        return $this;
    }

    public function removeDemandeInterne(DemandeInterne $demandeInterne): static
    {
        if ($this->demandeInternes->removeElement($demandeInterne)) {
            // set the owning side to null (unless already changed)
            if ($demandeInterne->getAuteur() === $this) {
                $demandeInterne->setAuteur(null);
            }
        }

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
            $commentaireDemande->setAuteur($this);
        }

        return $this;
    }

    public function removeCommentaireDemande(CommentaireDemande $commentaireDemande): static
    {
        if ($this->commentaireDemandes->removeElement($commentaireDemande)) {
            // set the owning side to null (unless already changed)
            if ($commentaireDemande->getAuteur() === $this) {
                $commentaireDemande->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): static
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setEmployee($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getEmployee() === $this) {
                $presence->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setAuteur($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getAuteur() === $this) {
                $notification->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setResponsable($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getResponsable() === $this) {
                $projet->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MembreEquipe>
     */
    public function getMembreEquipes(): Collection
    {
        return $this->membreEquipes;
    }

    public function addMembreEquipe(MembreEquipe $membreEquipe): static
    {
        if (!$this->membreEquipes->contains($membreEquipe)) {
            $this->membreEquipes->add($membreEquipe);
            $membreEquipe->setMembre($this);
        }

        return $this;
    }

    public function removeMembreEquipe(MembreEquipe $membreEquipe): static
    {
        if ($this->membreEquipes->removeElement($membreEquipe)) {
            // set the owning side to null (unless already changed)
            if ($membreEquipe->getMembre() === $this) {
                $membreEquipe->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjetAssigne(): Collection
    {
        return $this->projetAssigne;
    }

    public function addProjetAssigne(Projet $projetAssigne): static
    {
        if (!$this->projetAssigne->contains($projetAssigne)) {
            $this->projetAssigne->add($projetAssigne);
            $projetAssigne->setAssignant($this);
        }

        return $this;
    }

    public function removeProjetAssigne(Projet $projetAssigne): static
    {
        if ($this->projetAssigne->removeElement($projetAssigne)) {
            // set the owning side to null (unless already changed)
            if ($projetAssigne->getAssignant() === $this) {
                $projetAssigne->setAssignant(null);
            }
        }

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
            $tacheProjet->setAssignant($this);
        }

        return $this;
    }

    public function removeTacheProjet(TacheProjet $tacheProjet): static
    {
        if ($this->tacheProjets->removeElement($tacheProjet)) {
            // set the owning side to null (unless already changed)
            if ($tacheProjet->getAssignant() === $this) {
                $tacheProjet->setAssignant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TacheNormale>
     */
    public function getTacheNormales(): Collection
    {
        return $this->tacheNormales;
    }

    public function addTacheNormale(TacheNormale $tacheNormale): static
    {
        if (!$this->tacheNormales->contains($tacheNormale)) {
            $this->tacheNormales->add($tacheNormale);
            $tacheNormale->setAssigne($this);
        }

        return $this;
    }

    public function removeTacheNormale(TacheNormale $tacheNormale): static
    {
        if ($this->tacheNormales->removeElement($tacheNormale)) {
            // set the owning side to null (unless already changed)
            if ($tacheNormale->getAssigne() === $this) {
                $tacheNormale->setAssigne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setEnvoyeur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEnvoyeur() === $this) {
                $message->setEnvoyeur(null);
            }
        }

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
            $membreGroupe->setMembre($this);
        }

        return $this;
    }

    public function removeMembreGroupe(MembreGroupe $membreGroupe): static
    {
        if ($this->membreGroupes->removeElement($membreGroupe)) {
            // set the owning side to null (unless already changed)
            if ($membreGroupe->getMembre() === $this) {
                $membreGroupe->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DemandeInterne>
     */
    public function getDemandeInterneTraite(): Collection
    {
        return $this->demandeInterneTraite;
    }

    public function addDemandeInterneTraite(DemandeInterne $demandeInterneTraite): static
    {
        if (!$this->demandeInterneTraite->contains($demandeInterneTraite)) {
            $this->demandeInterneTraite->add($demandeInterneTraite);
            $demandeInterneTraite->setResponsable($this);
        }

        return $this;
    }

    public function removeDemandeInterneTraite(DemandeInterne $demandeInterneTraite): static
    {
        if ($this->demandeInterneTraite->removeElement($demandeInterneTraite)) {
            // set the owning side to null (unless already changed)
            if ($demandeInterneTraite->getResponsable() === $this) {
                $demandeInterneTraite->setResponsable(null);
            }
        }

        return $this;
    }

}
