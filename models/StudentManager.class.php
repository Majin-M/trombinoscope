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
    /**
     * @description Ajoute un étudiant à la liste des étudiants
     * @param Student $student L'étudiant à ajouter
     * @return void
     */
    public function addStudent($student)
    {
        array_push($this->students, $student);
        //$this->students[] = $student;

    }
    /**
     * @description Retourne un étudiant par son identifiant
     * @param int $id L'identifiant de l'étudiant
     * @return Student L'étudiant
     */
    public function getStudentById($id)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM student WHERE id = :id");
        $req->execute(["id" => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * @description Supprime un étudiant de la liste des étudiants
     * @param int $id L'identifiant de l'étudiant
     * @return void
     */
    public function deleteStudentFromDB($id)
    {
        $req = $this->getBdd()->prepare("DELETE FROM student WHERE id = :id");
        $req->execute([
            "id" => $id
        ]);
    }
    /**
     * @description Met à jour les informations d'un étudiant dans la Base de données
     * @param int $id L'identifiant de l'étudiant
     * @param string $photo L'URL de l photo de l'étudiant
     * @param string $nom Le nom de l'étudiant
     * @param string $prenom Le prénom de l'étudiant
     * @param string $github L'URL de GitHub de l'étudiant
     * @param string $linkedin L'URL de LinkedIn de l'étudiant
     * @param string $portfolio L'URL de portfolio de l'étudiant
     * @param int $age L'âge de l'étudiant
     * @param string $description La description de l'étudiant
     * @return void
     */
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
    /**
     * @description Ajoute un étudiant dans la Base de données
     * @param string $photo L'URL de l photo de l'étudiant
     * @param string $nom Le nom de l'étudiant
     * @param string $prenom Le prénom de l'étudiant
     * @param string $github L'URL de GitHub de l'étudiant
     * @param string $linkedin L'URL de LinkedIn de l'étudiant
     * @param string $portfolio L'URL de portfolio de l'étudiant
     * @param int $age L'âge de l'étudiant
     * @param string $description La description de l'étudiant
     * @return void
     */
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
    /**
     * @description Compte les étudiants dont aucune colonne n'est vide dans la Base de données
     * @return int Le nombre de profils complets
     */
    public function countCompleteProfiles(): int
    {
        $req = $this->getBdd()->prepare("
        SELECT COUNT(*) 
        FROM student 
        WHERE photo       IS NOT NULL AND photo       != ''
        AND   nom         IS NOT NULL AND nom         != ''
        AND   prenom      IS NOT NULL AND prenom      != ''
        AND   age         IS NOT NULL AND age         != ''
        AND   github      IS NOT NULL AND github      != ''
        AND   linkedin    IS NOT NULL AND linkedin    != ''
        AND   portfolio   IS NOT NULL AND portfolio   != ''
        AND   description IS NOT NULL AND description != ''
    ");
        $req->execute();
        return (int) $req->fetchColumn();
    }
    /**
     * @description Charge tous les étudiants de la Bdd et les ajoute au tableau $students
     * @return void
     */
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
