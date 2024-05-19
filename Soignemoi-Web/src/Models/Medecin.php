<?php

namespace App\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
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

    // Relation Medecins-Patients
    #[ManyToMany(targetEntity: Patient::class, inversedBy: 'medecins')]
    #[JoinTable(name: 'auscultations')]
    private Collection $patients;

    public function __construct()
    {
        $this->aviss = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
        $this->patients = new ArrayCollection();
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

    public function getAvis(): Collection
    {
        return $this->aviss;
    }

    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;

    }

    public function getPatients(): Collection
    {
        return $this->patients;
    }

    
}
