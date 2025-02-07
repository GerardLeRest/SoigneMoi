<?php

namespace App\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity()]
#[Table(name: "patients")]
class Patient
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: "integer")]
    private int $idPatient;

    #[Column(type: "string", length: 255)]
    private string $prenom;

    #[Column(type: "string", length: 100)]
    private string $nom;

    #[Column(type: "string", length: 100)]
    private string $adressePostale;

    #[Column(type: "string", length: 255)]
    private string $email;

    #[Column(type: "string", length: 255)]
    private string $motDePasse;

    // Relation Patient-Sejour
    /**
     * @var Collection<int, Sejour>
     */
    #[OneToMany(targetEntity: Sejour::class, mappedBy: 'patient')]
    private Collection $sejours;

    // Relation Patient-Prescription
    /**
     * @var Collection<int, Prescription>
     */
    #[OneToMany(targetEntity: Prescription::class, mappedBy: 'patient')]
    private Collection $prescriptions;

    // Relation Patient-Avis
    /**
     * @var Collection<int, Avis>
     */
    #[OneToMany(targetEntity: Avis::class, mappedBy: 'patient')]
    private Collection $aviss;

    public function __construct()
    {
        $this->sejours = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
        $this->aviss = new ArrayCollection();
    }
        
    public function getIdPatient(): int
    {
        return $this->idPatient;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getAdressePostale(): string
    {
        return $this->adressePostale;
    }

    public function setAdressePostale(string $adressePostale): void
    {
        $this->adressePostale = $adressePostale;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @return Collection<int, Sejour>
     */
    public function getSejours(): ?Collection
    {
        return $this->sejours;
    }

    public function addSejour(Sejour $sejour): static
    {
        if (!$this->sejours->contains($sejour)) {
            $this->sejours->add($sejour);
            $sejour->setIdPatient($this);
        }

        return $this;
    }

    public function removeSejour(Sejour $sejour): static
    {
        if ($this->sejours->removeElement($sejour)) {
            // set the owning side to null (unless already changed)
            if ($sejour->getIdPatient() === $this) {
                $sejour->setIdPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->aviss;
    }

    public function addAvi(Avis $avis): static
    {
        if (!$this->aviss->contains($avis)) {
            $this->aviss->add($avis);
            $avis->setIdPatient($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avis): static
    {
        if ($this->aviss->removeElement($avis)) {
            // set the owning side to null (unless already changed)
            if ($avis->getIdPatient() === $this) {
                $avis->setIdPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): static
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
            $prescription->setIdPatient($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): static
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getIdPatient() === $this) {
                $prescription->setIdPatient(null);
            }
        }

        return $this;
    }
    

}
