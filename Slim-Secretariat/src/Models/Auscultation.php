<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "auscultations")]
class Auscultation
{
    #[Id]
    #[ManyToOne(targetEntity: "Medecin", inversedBy: "auscultations")]
    #[JoinColumn(name: "idMedecin", referencedColumnName: "idMedecin")]
    private Medecin $medecin;

    #[Id]
    #[ManyToOne(targetEntity: "Patient")]
    #[JoinColumn(name: "idPatient", referencedColumnName: "idPatient")]
    private Patient $patient;

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
