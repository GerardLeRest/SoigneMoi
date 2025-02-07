<?php

namespace Tests\Models;

use App\Models\Medecin;
use App\Models\Avis;
use App\Models\Patient;
use App\Models\Prescription;
use DateTime;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class MedecinTest extends TestCase {

    public function testGetSetPrenom(){
        $medecin = new Medecin();
        $medecin->setPrenom("Antoine");
        $this->assertSame("Antoine", $medecin->getPrenom());
    }

    public function testGetSetNom(){
        $medecin = new Medecin();
        $medecin->setNom("DUPONT");
        $this->assertSame("DUPONT", $medecin->getNom());
    }

    public function testGetSetMatricule(){
        $medecin = new Medecin();
        $medecin->setMatricule("BC1542");
        $this->assertEquals("BC1542", $medecin->getMatricule());
    }

    public function testGetSetSpecialite(){
        $medecin = new Medecin();
        $medecin->setSpecialite("Cardiologue");
        $this->assertEquals("Cardiologue", $medecin->getSpecialite());
    }

    public function testAddGetAvis(){

    $medecin = new Medecin();
    // Créer des instances réelles de Medecin
    $medecin1 = new Medecin();
    $medecin2 = new Medecin();
    $medecin3 = new Medecin();
    
    $patient = new Patient();
    // Créer des instances réelles de Patient
    $patient1 = new Patient();
    $patient2 = new Patient();
    $patient3 = new Patient();

    // Créer des instances de Avis avec des valeurs spécifiques
    $avis1 = new Avis();
    $avis1->setDate(new DateTime('2024-08-20'));
    $avis1->setLibelle('libelle1');
    $avis1->setDescription('Description1');
    $avis1->setMedecin($medecin1);
    $avis1->setPatient($patient1);  

    $avis2 = new Avis();
    $avis2->setDate(new DateTime('2024-08-21'));
    $avis2->setLibelle('libelle2');
    $avis2->setDescription('Description1');
    $avis2->setMedecin($medecin2);
    $avis2->setPatient($patient2);  

    $avis3 = new Avis();
    $avis3->setDate(new \DateTime('2024-08-22'));
    $avis3->setLibelle('libelle3');
    $avis3->setDescription('Description3');
    $avis3->setMedecin($medecin3);
    $avis3->setPatient($patient3);  // Associe un troisième patient à cet avis

   // Ajouter les avis à la collection
   $medecin->getAvis()->add($avis1);
   $medecin->getAvis()->add($avis2);
   $medecin->getAvis()->add($avis3);

    // Vérifier que getAvis() renvoie le tableau de collection
    $this->assertInstanceOf(ArrayCollection::class, $medecin->getAvis());
    // vérifier qu'il y a trois éléments dans la collection
    $this->assertCount(3, $medecin->getAvis());
    // vérifier le premier élément
    $this->assertSame($avis1, $medecin->getAvis()->first());
    // vérifier le dernier élément
    $this->assertSame($avis3, $medecin->getAvis()->last());
    }

    public function testAddgetPrescription(){

        $medecin = new Medecin();
        // Créer des instances réelles de Medecin
        $medecin1 = new Medecin();
        $medecin2 = new Medecin();
        $medecin3 = new Medecin();
        
        $patient = new Patient();
        // Créer des instances réelles de Patient
        $patient1 = new Patient();
        $patient2 = new Patient();
        $patient3 = new Patient();
    
        // Créer des instances de Prescription avec des valeurs spécifiques
        $prescription1 = new Prescription();
        $prescription1->setNomMedicament('medicament1');
        $prescription1->setPosologie('posologie1');
        $prescription1->setDateDeDebut(new DateTime('2024-08-20'));
        $prescription1->setDateDeFin(new DateTime('2024-08-27'));
        $prescription1->setMedecin($medecin1);
        $prescription1->setPatient($patient1);  
    
        $prescription2 = new Prescription();
        $prescription2->setNomMedicament('medicament2');
        $prescription2->setPosologie('posologie2');
        $prescription2->setDateDeDebut(new DateTime('2024-08-21'));
        $prescription2->setDateDeFin(new DateTime('2024-08-28'));
        $prescription2->setMedecin($medecin2);
        $prescription2->setPatient($patient2);    
    
        $prescription3 = new Prescription();
        $prescription3->setNomMedicament('medicament3');
        $prescription3->setPosologie('posologie3');
        $prescription3->setDateDeDebut(new DateTime('2024-08-22'));
        $prescription3->setDateDeFin(new DateTime('2024-08-29'));
        $prescription3->setMedecin($medecin3);
        $prescription3->setPatient($patient3);  

       // Ajouter les prescritions à la collection
       $medecin->getPrescription()->add($prescription1);
       $medecin->getPrescription()->add($prescription2);
       $medecin->getPrescription()->add($prescription3);
    
        // Vérifier que getPrescription() renvoie le tableau de collection
        $this->assertInstanceOf(ArrayCollection::class, $medecin->getPrescription());
        // vérifier qu'il y a trois éléments dans la collection
        $this->assertCount(3, $medecin->getPrescription());
        // vérifier le premier élément
        $this->assertSame($prescription1, $medecin->getPrescription()->first());
        // vérifier le dernier élément
        $this->assertSame($prescription3, $medecin->getPrescription()->last());
    }
}