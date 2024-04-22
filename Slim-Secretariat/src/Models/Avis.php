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
#[Table(name: "avis")]
class Avis
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: "integer")]
    private int $idAvis;

    #[Column(type: "date")]
    private DateTime $date;

    #[Column(type: "string", length: 100)]
    private string $libelle;

    #[Column(type: "text")]
    private string $description;

    #[ManyToOne(targetEntity: Medecin::class)]
    #[JoinColumn(name: "idMedecin", referencedColumnName: "idMedecin")]
    private Medecin $medecin;

    public function getIdAvis(): ?int
    {
        return $this->idAvis;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getMedecin(): Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(Medecin $medecin): void
    {
        $this->medecin = $medecin;
    }
}
