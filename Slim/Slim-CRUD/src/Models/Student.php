<?php

namespace App\Models;

//Student.php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "students")]
class Student{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(name: "first_name", type: "string", length: 50, nullable: false)]
    private $firstname; // le nom de la colonne de la base de donnée est différent. Im faut l'indiquer.

    #[ORM\Column(type: "string", length: 50, nullable: false)]
    private $surname;

    #[ORM\Column(type: "integer", nullable: false)]
    private $age;

    // Getter de l'Id
    public function getId()
    {
        return $this->id;
    }

    // Getter et setterde "surname" 
    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    // Getter et setter pour firstname
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    // Getter et setter pour "age"
    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age): void
    {
        $this->age = $age;
    } 
}

