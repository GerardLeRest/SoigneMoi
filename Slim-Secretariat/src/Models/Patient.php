<?php

namespace App\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
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

    // Relation Patient-Sejours
    #[OneToMany(targetEntity: Sejour::class, mappedBy: 'patient')]
    private Collection $sejours;

    // Relation Patient-Medecins
    #[ManyToMany(targetEntity: Medecin::class, inversedBy: 'patients')]
    #[JoinTable(name: 'auscultations')]
    private Collection $medecins;

    public function __construct()
    {
        $this->sejours = new ArrayCollection();
        $this->medecins = new ArrayCollection();
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

    public function getSejours(): Collection
{
    return $this->sejours;
}
}
