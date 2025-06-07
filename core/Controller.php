<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);
        require_once "app/views/layouts/main.php";
    }
}
