<?php
require_once __DIR__ . '/controllers/Router.php';
// définit la racine une seule fois
define('BASE_URL', '/trombinoscope/');

$route =new Router();
$route->routeReq();
?>