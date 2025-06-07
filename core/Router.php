<?php
class Router {
    public function run() {
        $url = $_GET['url'] ?? 'article/index';
        $parts = explode('/', $url);
        $controllerName = ucfirst($parts[0]) . 'Controller';
        $method = $parts[1] ?? 'index';
        $param = $parts[2] ?? null;

        if (!file_exists("app/controllers/$controllerName.php")) die('404 Controller not found');

        $controller = new $controllerName();
        if (!method_exists($controller, $method)) die('404 Method not found');

        if ($param) $controller->$method($param);
        else $controller->$method();
    }
}
