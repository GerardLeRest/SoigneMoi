<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Patients")]
class Patient
{
    #[ORM\Id]
    #[ORM\Column(name: "id_patient", type: "integer")]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $prenom;

    #[ORM\Column(type: "string", length: 100)]
    private $nom;

    #[ORM\Column(name: "adresse_Postale", type: "string", length: 100)]
    private $adressePostale;

    #[ORM\Column(type: "string", length: 255)]
    private $email;

    #[ORM\Column(name: "mot_De_Passe", type: "string", length: 100)]
    private $motDePasse;

    #[ORM\ManyToOne(targetEntity: "Medecin")]
    #[ORM\JoinColumn(name: "idMedecin", referencedColumnName: "id")]
    private $medecin;

    // Getters and setters
}

