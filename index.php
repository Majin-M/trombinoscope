<?php
require_once __DIR__ . '/controllers/Autoloader.php';
Autoloader::register();
require_once __DIR__ . '/controllers/Router.php';
// index.php — définit la racine une seule fois
define('BASE_URL', '/trombinoscope/');

$route =new Router();
$route->routeReq();
?>