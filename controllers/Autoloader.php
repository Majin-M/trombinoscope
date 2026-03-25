<?php
class Autoloader
{

    public static function register()
    {
        spl_autoload_register(function ($class) {
            $paths = [
                'models/' . $class . '.class.php',
                'controllers/' . $class . '.php'
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    require_once $path;
                    return;
                }
            }
        });
    }
}
