<?php
class AuthController extends Controller {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            User::create($username, $email, $password);
            header('Location: /blog/public/index.php?url=auth/login');
            exit;
        }

        $this->view('auth/register');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::findByUsername($_POST['username']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /blog/public/index.php?url=article/index');
                exit;
            } else {
                echo "Nesprávné přihlašovací údaje.";
            }
        }

        $this->view('auth/login');
    }

    public function logout() {
        session_destroy();
        header('Location: /blog/public/index.php?url=auth/login');
    }
}
