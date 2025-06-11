<?php
class Router {
    public function run() {
        // Získání hodnoty z parametru "url" v query stringu
         // Pokud není zadán, použije se výchozí hodnota "article/index"
        $url = $_GET['url'] ?? 'article/index';
        $parts = explode('/', $url);  // Rozdělení URL podle lomítek

        // Vytvoření názvu controlleru – první část URL + "Controller"
        $controllerName = ucfirst($parts[0]) . 'Controller';
        $method = $parts[1] ?? 'index';
        $param = $parts[2] ?? null;

        // Sestavení cesty k PHP souboru s controllerem
        $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

        if (!file_exists($controllerPath)) { // Pokud soubor controlleru neexistuje, ukončí aplikaci s chybovou hláškou
            die("❌ Controller '$controllerName' not found.");
        }

        // Načtení souboru controlleru
        require_once $controllerPath;
        $controller = new $controllerName(); // Vytvoření instance controlleru podle názvu třídy

        // Kontrola, zda v controlleru existuje požadovaná metoda
        if (!method_exists($controller, $method)) {
            die("❌ Method '$method' not found.");
        }

        // Zavolání metody s parametrem, pokud je k dispozici
        if ($param !== null) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }
}
