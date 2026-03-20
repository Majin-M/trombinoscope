<?php
require_once "Model.class.php";
require_once "Student.class.php";
class StudentManager extends Model
{
    private $students = [];

    public function getStudent()
    {
        return $this->students;
    }

    public function addStudent($student)
    {
        array_push($this->students, $student);
        //$this->students[] = $student;

    }
    //méthode qui charge tous les étudiants de la Bdd et les ajoute au tableau $students
    public function loadStudents()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM student");
        $req->execute();
        //transforme les données de la requête en un tableau associatif
        $cda_students = $req->fetchAll(PDO::FETCH_ASSOC);
        //crée un objet Student pour chaque étudiant et l'ajoute au tableau $students
        foreach ($cda_students as $cda_student) {
            $etudiant = new Student($cda_student["id"], $cda_student["photo"], $cda_student["nom"], $cda_student["prenom"],$cda_student["github"],$cda_student["linkedin"],$cda_student["portfolio"], $cda_student["age"], $cda_student["description"]);
            $this->addStudent($etudiant);
        }

    }
}
?>