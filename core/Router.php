<?php
class Router {
    public function run() {
        $url = $_GET['url'] ?? 'article/index';
        $parts = explode('/', $url);

        $controllerName = ucfirst($parts[0]) . 'Controller';
        $method = $parts[1] ?? 'index';
        $param = $parts[2] ?? null;

        $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

        if (!file_exists($controllerPath)) {
            die("❌ Controller '$controllerName' not found.");
        }

        require_once $controllerPath;
        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            die("❌ Method '$method' not found.");
        }

        if ($param !== null) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }
}
