<?php
require_once 'controllers/Autoloader.php';

class Router
{
    private StudentController $_ctrl;

    public function __construct()
    {
        Autoloader::register();
        $this->_ctrl = new StudentController();
    }

    public function routeReq(): void
    {
        try {
            // URL par défaut si rien n'est fourni
            $url = isset($_GET['url'])
                ? explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL))
                : ['student', 'accueil'];

            // L'action correspond au deuxième segment de l'URL
            $action = $url[1] ?? 'accueil';

            if (method_exists($this->_ctrl, $action)) {
                $this->_ctrl->$action();
            } else {
                throw new Exception("Action introuvable : $action");
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

   
}