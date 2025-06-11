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

   
}
