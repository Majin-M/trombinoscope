<?php
require_once 'models/StudentManager.class.php';
class StudentController
{

    private $manager;

    public function __construct($url = [])
    {
        $this->manager = new StudentManager();
    }

    public function accueil()
    {
        return require 'views/AccueilView.php';
    }
    public function presentation()
    {
        return require 'views/PresentationView.php';
    }
    public function promotion()
    {
        $this->manager->loadStudents();
        $students = $this->manager->getStudent();
        return require 'views/PromotionView.php';
    }
    public function contact()
    {
        return require 'views/ContactView.php';
    }
   public function admin()
{
    $this->manager->loadStudents();
    $students = $this->manager->getStudent();
    $completeProfiles = $this->manager->countCompleteProfiles();

    // Récupère l'étudiant à modifier si id_edit est dans l'URL

       $etudiantAModifier = null;
if (isset($_GET["id_edit"])) {
        $etudiantAModifier = $this->manager->getStudentById($_GET["id_edit"]);
       
        }
    

    return require 'views/AdminView.php';
}
    public function add()
    {
        if (isset($_POST["submit"]) && $_POST["submit"] == "Ajouter") {
        //On récupère le fichier ce trouvant dans le dossier temporaire dans une variable
        $dossierTemporaire = $_FILES["photo"]["tmp_name"];
        //On récupère le chemin vers le dossier où on veut télécharger l'image
        $dossierDefinitif = "public/img/" . $_FILES["photo"]["name"];
        //On récupère les caratères de la chaine de caractères composant le nom du fichier à partir du point "."
        //on déplace le fichier du dossier temporaire au dossier définitif
        move_uploaded_file($dossierTemporaire, $dossierDefinitif);
            $this->manager->addStudentInDB(
                $_FILES["photo"]["name"] ?? null,
                $_POST["nom"] ?? null,
                $_POST["prenom"] ?? null,
                $_POST["github"] ?? null,
                $_POST["linkedin"] ?? null,
                $_POST["portfolio"] ?? null,
                $_POST["age"] ?? null,
                $_POST["description"] ?? null
            );

            header("Location: admin"); // retourne sur la page avec un Get
            exit();
        }
    }
    public function delete()
    {
        if (isset($_POST["delete"]) && $_POST["delete"] == "Supprimer" && isset($_POST["id_delete"])) {
            $this->manager->deleteStudentFromDB($_POST["id_delete"]);
            header("Location: admin");
            exit();
        }
    }
    public function update()
    {
        if (isset($_POST["submit"]) && $_POST["submit"] == "Enregistrer") {
         // On vérifie si une nouvelle photo a été envoyée
        if (!empty($_FILES["photo"]["name"])) {
            // Nouvelle photo — on déplace le fichier
            $dossierTemporaire = $_FILES["photo"]["tmp_name"];
            $dossierDefinitif  = "public/img/" . $_FILES["photo"]["name"];
            move_uploaded_file($dossierTemporaire, $dossierDefinitif);
            $photo = $_FILES["photo"]["name"];
        } else {
            // Pas de nouvelle photo
            $photo = $_POST["photo_actuelle"] ?? null;
        }
            $this->manager->updateStudent(
                $_POST["id"],
                $photo,
                $_POST["nom"],
                $_POST["prenom"],
                $_POST["github"],
                $_POST["linkedin"],
                $_POST["portfolio"],
                $_POST["age"],
                $_POST["description"]
            );

            header("Location: admin");
            exit();
        }
    }
}
