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
    public function getStudentById($id)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM student WHERE id = :id");
        $req->execute(["id" => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteStudentFromDB($id)
    {
        $req = $this->getBdd()->prepare("DELETE FROM student WHERE id = :id");
        $req->execute([
            "id" => $id
        ]);
    }
    public function updateStudent($id, $photo, $nom, $prenom, $github, $linkedin, $portfolio, $age, $description)
    {
        $req = $this->getBdd()->prepare(" UPDATE student 
     SET photo=:photo, nom=:nom, prenom=:prenom, github=:github, linkedin=:linkedin, portfolio=:portfolio, age=:age, description=:description  
    WHERE id=:id
    ");

        $req->execute([
            "id" => $id,
            "photo" => $photo,
            "nom" => $nom,
            "prenom" => $prenom,
            "github" => $github,
            "linkedin" => $linkedin,
            "portfolio" => $portfolio,
            "age" => $age,
            "description" => $description
        ]);
    }
    //méthode qui ajoute un étudiant dans la Base de données
    public function addStudentInDB($photo, $nom, $prenom, $github, $linkedin, $portfolio, $age, $description)
    {
        $req = $this->getBdd()->prepare("INSERT INTO student (photo,nom,prenom,github,linkedin,portfolio,age,description) VALUES (:photo,:nom,:prenom,:github,:linkedin,:portfolio,:age,:description)");
        $req->execute([
            "photo" => $photo,
            "nom" => $nom,
            "prenom" => $prenom,
            "github" => $github,
            "linkedin" => $linkedin,
            "portfolio" => $portfolio,
            "age" => $age,
            "description" => $description
        ]);
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
            $etudiant = new Student($cda_student["id"], $cda_student["photo"], $cda_student["nom"], $cda_student["prenom"], $cda_student["github"], $cda_student["linkedin"], $cda_student["portfolio"], $cda_student["age"], $cda_student["description"]);
            $this->addStudent($etudiant);
        }
    }
}
