<?php
class UserController extends Controller {

    //zobrazení profilu uživatele
    public function profile() {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "index.php?url=auth/login"); //pokud není přihlášen, přesměrován na login
            exit;
        }

        $user = User::findById($_SESSION['user']['id']); //načte informace z databáze
        $this->view('user/profile', ['user' => $user]); //zobrazí user profile.php
    }

    //seznam článků přihlášeného uživatele
    public function myPosts() {
        $articles = Article::findByUser($_SESSION['user']['id']); //model Article - získání všech článků uživatele
        $this->view('user/my_posts', ['articles' => $articles]);
    }

    //seznam komentářů přihlášeného uživatele
    public function myComments() {
        $comments = Comment::findByUser($_SESSION['user']['id']);
        $this->view('user/my_comments', ['comments' => $comments]);
    }

    //změna hesla
    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //požadavek na změnu hesla
            $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); //nové heslo
            User::updatePassword($_SESSION['user']['id'], $newPassword); //modelová metoda uloží nové heslo
            echo "Heslo změněno.";
            exit;
        }

        $this->view('user/change_password');
    }
}
