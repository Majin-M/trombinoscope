<?php
require_once 'controllers/Autoloader.php';
class Router{
    private $_ctrl;
    public function routeReq(){
        try {
            Autoloader::register();
            $url = '';

            if(isset($_GET['url'])){
                $url = explode('/',filter_var($_GET['url'],FILTER_SANITIZE_URL));
                $controllerName = ucfirst($url[0])."Controller";
                if(class_exists($controllerName)){
                    $this->_ctrl = new $controllerName($url);
                    $action = $url[1];
                    if (method_exists($this->_ctrl, $action)) {
                        $this->_ctrl->$action();
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