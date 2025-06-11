<?php
session_start(); // Spuštění session – umožňuje pracovat s $_SESSION (přihlašování, zprávy...)

define('DB_HOST', 'localhost'); //adresa serveru databaze
define('DB_NAME', 'blog'); //název databáze
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', '/blog/public/'); // Základní URL pro generování cest a odkazů v celé aplikaci

//funkce pro automatické načítání tříd z určených složek
spl_autoload_register(function ($class) {
    // Pole složek, kde budou hledány třídy (Core, Controllers, Models)
    foreach (['core', 'app/controllers', 'app/models'] as $folder) {
        // Cesta ke konkrétní třídě (např. core/Controller.php)
        $file = __DIR__ . '/../' . $folder . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
