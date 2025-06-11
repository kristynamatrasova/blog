<?php
class Controller { //Načte view šablonu a předá do ní data.
    public function view($view, $data = []) {
        extract($data);  // vytvoří proměnné z klíčů pole $data
        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';
        require __DIR__ . '/../app/views/layouts/main.php';
    }
}
