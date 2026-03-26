<?php
class Autoloader
{
//fonction qui charge toutes les classe du projet
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $paths = [
                'models/' . $class . '.class.php',
                'controllers/' . $class . '.php'
            ];
            //si le chemin mentioné correspond à un fichier on le requiert une bonne fois
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    require_once $path;
                    return;
                }
            }
        });
    }
}
