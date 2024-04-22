<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Prescriptions")]
class Prescription
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(name: "nom_medicament", type: "string", length: 100)]
    private $nomMedicament;

    #[ORM\Column(type: "string", length: 100)]
    private $posologie;

    #[ORM\Column(name: "date_de_Debut", type: "date")]
    private $dateDeDebut;

    #[ORM\Column(name: "date_de_fin", type: "date")]
    private $dateDeFin;

    #[ORM\ManyToOne(targetEntity: "Medecin")]
    #[ORM\JoinColumn(name: "idMedecin", referencedColumnName: "id")]
    private $medecin;

    // Getters and setters

    /**
     * Get the value of nomMedicament
     */ 
    public function getNomMedicament()
    {
        return $this->nomMedicament;
    }

    /**
     * Set the value of nomMedicament
     *
     * @return  self
     */ 
    public function setNomMedicament($nomMedicament)
    {
        $this->nomMedicament = $nomMedicament;

        return $this;
    }

    /**
     * Get the value of posologie
     */ 
    public function getPosologie()
    {
        return $this->posologie;
    }

    /**
     * Set the value of posologie
     *
     * @return  self
     */ 
    public function setPosologie($posologie)
    {
        $this->posologie = $posologie;

        return $this;
    }

    /**
     * Get the value of dateDeDebut
     */ 
    public function getDateDeDebut()
    {
        return $this->dateDeDebut;
    }

    /**
     * Set the value of dateDeDebut
     *
     * @return  self
     */ 
    public function setDateDeDebut($dateDeDebut)
    {
        $this->dateDeDebut = $dateDeDebut;

        return $this;
    }

    /**
     * Get the value of medecin
     */ 
    public function getMedecin()
    {
        return $this->medecin;
    }

    /**
     * Set the value of medecin
     *
     * @return  self
     */ 
    public function setMedecin($medecin)
    {
        $this->medecin = $medecin;

        return $this;
    }

    /**
     * Get the value of dateDeFin
     */ 
    public function getDateDeFin()
    {
        return $this->dateDeFin;
    }

    /**
     * Set the value of dateDeFin
     *
     * @return  self
     */ 
    public function setDateDeFin($dateDeFin)
    {
        $this->dateDeFin = $dateDeFin;

        return $this;
    }
}
