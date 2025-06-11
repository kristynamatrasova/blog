<?php
//načte konfiguraci aplikace (připojení k DB, autoload)
require_once __DIR__ . '/../config/config.php';
//načte Router, směřování požadavků na správný controller
require_once __DIR__ . '/../core/Router.php';

//vytvoření instance routeru
$router = new Router();
//spuštění směřování
$router->run();
