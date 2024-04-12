<?php

namespace App\Controllers;

use App\Models\Student;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StudentController
{
    private  $entityManager;

    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
        
    public function createStudent(Request $request, Response $response): Response
    {
        //récupération des données
        $data = $request->getParsedBody();
        error_log(print_r($data, true), 3, __DIR__ . '/StudentController.log');

        // création des données de l'étudiant
        $student = new Student();
        $student->setFirstname($data['firstname']);
        $student->setSurname($data['surname']);
        $student->setAge($data['age']);

        //transfert des données de l'étudiant dans la base de données
        $this->entityManager->persist($student);
        $this->entityManager->flush();

        $response->getBody()->write('Étudiant créé avec succès avec l\'ID :' . $student->getId());
        return $response->withHeader('Content-Type', 'application/json');
    } 
}