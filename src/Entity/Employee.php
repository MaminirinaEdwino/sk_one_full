<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $emailpro = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $addresse = null;

    /**
     * @var Collection<int, Poste>
     */
    #[ORM\ManyToMany(targetEntity: Poste::class, inversedBy: 'employees')]
    private Collection $poste;

    /**
     * @var Collection<int, BU>
     */
    #[ORM\ManyToMany(targetEntity: BU::class, inversedBy: 'employees')]
    private Collection $BU;


    #[ORM\Column]
    private ?\DateTime $dateEntree = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateSortie = null;

    #[ORM\OneToOne(mappedBy: 'employee', cascade: ['persist', 'remove'])]
    private ?User $user_accout = null;

    /**
     * @var Collection<int, Conge>
     */
    #[ORM\OneToMany(targetEntity: Conge::class, mappedBy: 'employee')]
    private Collection $conges;

    /**
     * @var Collection<int, ParcoursEmploye>
     */
    #[ORM\OneToMany(targetEntity: ParcoursEmploye::class, mappedBy: 'employee')]
    private Collection $parcoursEmployes;

    public function __construct()
    {
        $this->poste = new ArrayCollection();
        $this->BU = new ArrayCollection();
        $this->conges = new ArrayCollection();
        $this->parcoursEmployes = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmailpro(): ?string
    {
        return $this->emailpro;
    }

    public function setEmailpro(string $emailpro): static
    {
        $this->emailpro = $emailpro;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): static
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * @return Collection<int, Poste>
     */
    public function getPoste(): Collection
    {
        return $this->poste;
    }

    public function addPoste(Poste $poste): static
    {
        if (!$this->poste->contains($poste)) {
            $this->poste->add($poste);
        }

        return $this;
    }

    public function removePoste(Poste $poste): static
    {
        $this->poste->removeElement($poste);

        return $this;
    }

    /**
     * @return Collection<int, BU>
     */
    public function getBU(): Collection
    {
        return $this->BU;
    }

    public function addBU(BU $bU): static
    {
        if (!$this->BU->contains($bU)) {
            $this->BU->add($bU);
        }

        return $this;
    }

    public function removeBU(BU $bU): static
    {
        $this->BU->removeElement($bU);

        return $this;
    }



    public function getDateEntree(): ?\DateTime
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTime $dateEntree): static
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getDateSortie(): ?\DateTime
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTime $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getUserAccout(): ?User
    {
        return $this->user_accout;
    }

    public function setUserAccout(?User $user_accout): static
    {
        // unset the owning side of the relation if necessary
        if ($user_accout === null && $this->user_accout !== null) {
            $this->user_accout->setEmployee(null);
        }

        // set the owning side of the relation if necessary
        if ($user_accout !== null && $user_accout->getEmployee() !== $this) {
            $user_accout->setEmployee($this);
        }

        $this->user_accout = $user_accout;

        return $this;
    }

    /**
     * @return Collection<int, Conge>
     */
    public function getConges(): Collection
    {
        return $this->conges;
    }

    public function addConge(Conge $conge): static
    {
        if (!$this->conges->contains($conge)) {
            $this->conges->add($conge);
            $conge->setEmployee($this);
        }

        return $this;
    }

    public function removeConge(Conge $conge): static
    {
        if ($this->conges->removeElement($conge)) {
            // set the owning side to null (unless already changed)
            if ($conge->getEmployee() === $this) {
                $conge->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParcoursEmploye>
     */
    public function getParcoursEmployes(): Collection
    {
        return $this->parcoursEmployes;
    }

    public function addParcoursEmploye(ParcoursEmploye $parcoursEmploye): static
    {
        if (!$this->parcoursEmployes->contains($parcoursEmploye)) {
            $this->parcoursEmployes->add($parcoursEmploye);
            $parcoursEmploye->setEmployee($this);
        }

        return $this;
    }

    public function removeParcoursEmploye(ParcoursEmploye $parcoursEmploye): static
    {
        if ($this->parcoursEmployes->removeElement($parcoursEmploye)) {
            // set the owning side to null (unless already changed)
            if ($parcoursEmploye->getEmployee() === $this) {
                $parcoursEmploye->setEmployee(null);
            }
        }

        return $this;
    }
}
