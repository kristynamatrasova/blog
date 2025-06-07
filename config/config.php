<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'blog'); // pokud máš jiný název databáze, změň
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', '/blog/public/');

spl_autoload_register(function ($class) {
    foreach (['core', 'app/controllers', 'app/models'] as $folder) {
        $file = __DIR__ . '/../' . $folder . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
