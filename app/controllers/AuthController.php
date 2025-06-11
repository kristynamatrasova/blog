<?php
class AuthController extends Controller {
    
    //registrace nového uživatele
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //POST kontroluje, zda uživatel odeslal formulář
            $username = $_POST['username'];
            $email = trim($_POST['email']);
            $email = $email !== '' ? $email : null;

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //hasheuje heslo
            
            User::create($username, $email, $password); //vytváří nového uživatele
            header('Location: /blog/public/index.php?url=auth/login'); //přeměrování na přihlašovací formulář
            exit;
        }

        $this->view('auth/register');
    }

    //přihlášení uživatele
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::findByUsername($_POST['username']); //načtení uživatele podle jména

            if ($user && password_verify($_POST['password'], $user['password'])) { //pokud je nalezen uživatel a zda odpovídá heslo
                $_SESSION['user'] = $user; //uživatel uložen do session a označen jako přihlášený
                header('Location: /blog/public/index.php?url=article/index');
                exit;
            } else {
                echo "Nesprávné přihlašovací údaje.";
            }
        }

        $this->view('auth/login'); // zobrazí přihlašovací formulář
    }

    //odhlášení uživatele
    public function logout() {
        session_destroy(); //zruší sessiom, uživatel odhlášen
        header('Location: /blog/public/index.php?url=auth/login');
    }
}
