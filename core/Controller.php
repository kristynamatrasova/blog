<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';
        require __DIR__ . '/../app/views/layouts/main.php';
    }
}
