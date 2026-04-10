<?php
require_once 'controllers/StudentController.php';

class Router
{
    private StudentController $controller;

    //lors de l'instanciation du routeur on instancie son attribue en même temps
    public function __construct()
    {   
        $this->controller = new StudentController();
    }

    /**
     * @description Route la requête de l'utilisateur vers la page correspondante
     * @return void
     */
    public function routeReq(): void
    {
        try {

            //si on un a un get url, la variable $url prends sa valeur
            $url = isset($_GET['url'])
                ? strtolower(filter_var($_GET['url'], FILTER_SANITIZE_URL))
                // URL par défaut si rien n'est fourni est l'accuil
                : 'accueil';

            //on affecte à la variable page le nom de la methode se trouvant dans l'url 
            $page = $url;
            //si cette methode existe dans notre objet $controller on l'utilise
            if (method_exists($this->controller, $page)) {
                $this->controller->$page();
            } else {
                throw new Exception("Page introuvable : $page");
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

   
}