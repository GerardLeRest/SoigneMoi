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
#[Table(name: "medecins")]
class Medecin
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: "integer")]
    private int $idMedecin;

    #[Column(type: "string", length: 100)]
    private string $matricule;

    #[Column(type: "string", length: 100)]
    private string $prenom;

    #[Column(type: "string", length: 100)]
    private string $nom;

    #[Column(type: "string", length: 100)]
    private string $specialite;

    // liaison Avis
    #[OneToMany(targetEntity: Avis::class, mappedBy: 'medecin')]
    private Collection $aviss;

    // Liaison Prescription
    #[OneToMany(targetEntity: Prescription::class, mappedBy: 'medecin')]
    private Collection $prescriptions;

    public function __construct()
    {
        $this->aviss = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
    }

    public function getIdMedecin(): int
    {
        return $this->idMedecin;
    }

    public function getMatricule(): string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): void
    {
        $this->matricule = $matricule;
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

    public function getSpecialite(): string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): void
    {
        $this->specialite = $specialite;
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
            $avis->setMedecin($this);
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
            $prescription->setIdMedecin($this);
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