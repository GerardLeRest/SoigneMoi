<?php

namespace App\models;

use App\Models\Patient;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "sejours")]
class Sejour
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: "integer")]
    private int $idSejour;

    #[Column(type: "date")]
    private DateTime $dateDebut;

    #[Column(type: "date", nullable: true)]
    private DateTime $dateFin;

    #[Column(type: "text")]
    private string $motifSejour;

    #[Column(type: "string", length: 100)]
    private string $specialite;

    #[Column(type: "string", length: 100)]
    private string $medecinSouhaite;

    #[ManyToOne(targetEntity: Patient::class)]
    #[JoinColumn(name: 'idPatient', referencedColumnName: 'idPatient')]
    private $patient;
    
    public function getDateDebut(): DateTime
    {
        return $this->dateDebut ;
    }

    public function setDateDebut(DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(): DateTime
    {
       return $this->dateFin;

    }

    public function setDateFin(DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    public function getMotifSejour(): string
    {
        return $this->motifSejour;
    }

    public function setMotifSejour(string $motifSejour): void
    {
        $this->motifSejour = $motifSejour;
    }

    public function getSpecialite(): string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): void
    {
        $this->specialite = $specialite;
    }

    public function getMedecinSouhaite(): string
    {
        return $this->medecinSouhaite;
    }

    public function setMedecinSouhaite(string $medecinSouhaite): void
    {
        $this->medecinSouhaite = $medecinSouhaite;
    }

    public function getPatient(): Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): void 
    {
        $this->patient = $patient;
    }

    public function getIdSejour(): int
    {
        return $this->idSejour;
    }
}
