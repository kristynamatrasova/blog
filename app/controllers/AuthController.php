<?php
class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::findByUsername($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /article/index');
                exit;
            }
            $error = "Neplatné přihlašovací údaje.";
        }
        require 'app/views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            User::create($_POST['username'], $_POST['email'], $hash);
            header('Location: /auth/login');
            exit;
        }
        require 'app/views/auth/register.php';
    }
}
