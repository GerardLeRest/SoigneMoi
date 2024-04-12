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
        $newStudent  = $request->getParsedBody();
        error_log(print_r($newStudent, true), 3, __DIR__ . '/StudentController.log');

        // création des données de l'étudiant
        $student = new Student();
        $student->setFirstname($newStudent['firstname']);
        $student->setSurname($newStudent['surname']);
        $student->setAge($newStudent['age']);

        //transfert des données de l'étudiant dans la base de données
        $this->entityManager->persist($student);
        $this->entityManager->flush();

        $response->getBody()->write('Étudiant avec l\'ID ' . $student->getId() . ' créé');
        return $response->withHeader('Content-Type', 'application/json');
    } 

    public function readStudent(Request $request, Response $response , array $args) : Response
    {
        $id = $args['id']; // récupération de l'id de l'URL
        $query = $this->entityManager->createQuery('SELECT s.surname, s.firstname, s.age FROM App\Models\Student s WHERE s.id = :id');
        $query->setParameter('id', $id);
        $student = $query->getOneOrNullResult(); // Essaye de récupérer un seul résultat - pas d'exception levées
        //$student sous la forme ['name' => 'John Doe', 'username' => 'johndoe', 'age' => 22] - 1 seule requête
        $studentData = ["ID" => $id, "surname" =>$student["surname"], "firstname" => $student["firstname"], "age" =>$student["age"]];
        $studentJSON = json_encode ($studentData); // conversion au format JSON
        $response->getBody()->write($studentJSON);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function updateStudent(Request $request, Response $response, array $args) : Response
    {
        $id = $args['id']; // récupération de l'id de l'URL
        $newStudent = $request->getParsedBody(); //récupération du nouvel élève dans un tableau

        // récupération des données de l'étudiant à mettre à jour
        //$student = $this->entityManager->getRepository(Student::class)->find($id);
        $query = $this->entityManager->createQuery('SELECT s FROM App\Models\Student s WHERE s.id = :id');
        $query->setParameter('id', $id);
        $student = $query->getOneOrNullResult(); // Essaye de récupérer un seul résultat ou un Null
        
        $student->setSurname($newStudent['surname']);
        $student->setFirstname($newStudent['firstname']);
        $student->setAge($newStudent['age']);

        // Persister les modifications
        $this->entityManager->flush();

        $response->getBody()->write($student->getFirstname() . " " . $student->getSurname() . " a été mis(e) à jour");
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deleteStudent(Request $request, Response $response, array $args){
        $id = $args['id'];
        $query = $this->entityManager->createQuery('DELETE App\Models\Student s WHERE s.id = :id');
        $query->setParameter('id', $id);
        // Exécution de la requête de suppression
        $query->execute();
        $response->getBody()->write("l'enregistrement de l'étudiant a été effacé");
        return $response->withHeader('Content-Type', 'application/json');
    }
}