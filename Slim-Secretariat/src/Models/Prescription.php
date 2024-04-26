<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity()]
#[Table(name: "prescriptions")]
class Prescription
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: "integer")]
    private int $idPrescription;

    #[Column(type: "string", length: 100)]
    private string $nomMedicament;

    #[Column(type: "string", length: 100)]
    private string $posologie;

    #[Column(type: "date")]
    private DateTime $dateDeDebut;

    #[Column(type: "date", nullable : true)]
    private DateTime $dateDeFin;

    #[ManyToOne (targetEntity: Medecin::class)]
    #[JoinColumn(name: "idMedecin", referencedColumnName: "idMedecin")]
    private Medecin $medecin;

    #[ManyToOne(targetEntity: Patient::class)]
    #[JoinColumn(name: "idPatient", referencedColumnName: "idPatient")]
    private Patient $patient;

    public function getIdPrescription(): int
    {
        return $this->idPrescription;
    }

    public function getNomMedicament(): string
    {
        return $this->nomMedicament;
    }

    public function setNomMedicament(string $nomMedicament): void
    {
        $this->nomMedicament = $nomMedicament;
    }

    public function getPosologie(): string
    {
        return $this->posologie;
    }

    public function setPosologie(string $posologie): void
    {
        $this->posologie = $posologie;
    }

    public function getDateDebut(): DateTime
    {
        return $this->dateDeDebut;
    }

    public function setDateDebut(DateTime $dateDeDebut): void
    {
        $this->dateDeDebut = $dateDeDebut;
    }

    public function getdateDeFin(): ?DateTime
    {
        return $this->dateDeFin;
    }

    public function setdateDeFin(?DateTime $dateDeFin): void
    {
        $this->dateDeFin = $dateDeFin;
    }

    public function getMedecin(): Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(Medecin $medecin): void
    {
        $this->medecin = $medecin;
    }

    public function getPatient(): Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): void
    {
        $this->patient = $patient;
    }
}