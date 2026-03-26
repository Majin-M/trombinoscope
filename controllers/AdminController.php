<?php
class AdminController
{

    private $manager;

    public function __construct($url = [])
    {
        $this->manager = new StudentManager();
    }

    // correspond à /admin/index
    public function index()
{
    $this->manager->loadStudents();

    $students = $this->manager;
    $etudiantAModifier = null;

    if (isset($_GET["id_edit"])) {
        $etudiantAModifier = $this->manager->getStudentById($_GET["id_edit"]);
    }

    require 'views/admin/index.php';
}

    public function add()
    {
        if (isset($_POST["submit"]) && $_POST["submit"] == "Ajouter") {
            $this->manager->addStudentInDB(
                $_POST["photo"] ?? null,
                $_POST["nom"] ?? null,
                $_POST["prenom"] ?? null,
                $_POST["github"] ?? null,
                $_POST["linkedin"] ?? null,
                $_POST["portfolio"] ?? null,
                $_POST["age"] ?? null,
                $_POST["description"] ?? null
            );

            header("Location: index.php?url=admin/index"); // retourne sur la page avec un Get
            exit();
        }
    }
    public function delete()
    {
        if (isset($_POST["delete"]) && $_POST["delete"] == "Supprimer" && isset($_POST["id_delete"])) {
            $this->manager->deleteStudentFromDB($_POST["id_delete"]);
            header("Location: index.php?url=admin/index"); 
            exit();
        }
    }
    public function update()
    {
        if (isset($_POST["submit"]) && $_POST["submit"] == "Enregistrer") {
            $this->manager->updateStudent(
                $_POST["id"],
                $_POST["photo"],
                $_POST["nom"],
                $_POST["prenom"],
                $_POST["github"],
                $_POST["linkedin"],
                $_POST["portfolio"],
                $_POST["age"],
                $_POST["description"]
            );

            header("Location: index.php?url=admin/index");
            exit();
        }
    }
}
