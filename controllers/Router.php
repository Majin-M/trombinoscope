<?php
require_once 'controllers/Autoloader.php'; 
class Router{
    private $_ctrl;
    public function routeReq(){
        try {
            Autoloader::register();//appelle toutes les classe dans le router
            $url = '';

            if(isset($_GET['url'])){
        //Sépare l'url en tableau des paramètres qui le composent
        //sanitize url sert à retirer tous les caractères en dehors des lettres latines
                $url = explode('/',filter_var($_GET['url'],FILTER_SANITIZE_URL));
                //la première le lettre du premier paramètre de l'url est mise en majuscule et le reste en minuscule
                $controllerName = ucfirst(strtolower($url[0]))."Controller";
                if(class_exists($controllerName)){ // on vérifie si la classe existe
                    //on instancie la variable $_ctrl comme un objet de cette classe
                    $this->_ctrl = new $controllerName($url); 
                    //le deuxième paramètre de l'url correspond compte à lui à une action faite sur cet objet
                    $action = $url[1];
                    if (method_exists($this->_ctrl, $action)) {//on vérifie si la méthode existe
                        $this->_ctrl->$action(); //on exécute la méthode
                    } else {
                        throw new Exception("Action introuvable");
                    }
                }
                else{
                    throw new Exception("Page introuvable");
                }
                
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
}
        }
    }

 ?>