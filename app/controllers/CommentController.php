<?php
class CommentController extends Controller {
    
    //vytvoření komentáře
    public function create($article_id) {
        if (!isset($_SESSION['user'])) { //zajišťuje, aby uživatel byl přihlášený
            header("Location: /blog/public/index.php?url=auth/login"); //pokud ne, přesměruje na login
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Comment::create($_SESSION['user']['id'], $article_id, $_POST['content']);
        }

        header("Location: /blog/public/index.php?url=article/detail/$article_id");
    }

    //úprava komentáře
    public function edit($id) {
    $comment = Comment::findById($id); //načte podle ID z databáze

    if (!$comment) {
        die("Komentář nenalezen.");
    }

    if ( //ověření přihlášení, je autor nebo admin
        !isset($_SESSION['user']) ||
        ($_SESSION['user']['id'] !== $comment['user_id'] && $_SESSION['user']['role'] !== 'admin')
    ) {
        die("Nemáš oprávnění upravit tento komentář.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Comment::update($id, $_POST['content']);
        header("Location: " . BASE_URL . "index.php?url=article/detail/" . $comment['article_id']);
        exit;
    }

    $this->view('comment/edit', ['comment' => $comment]);
}

//smazání komnetáře
public function delete($id) {
    $comment = Comment::findById($id); //načte podle ID

    if (!$comment) {
        die("Komentář nenalezen.");
    }

    if ( //zda je autorem nebo admin
        isset($_SESSION['user']) &&
        ($_SESSION['user']['id'] === $comment['user_id'] || $_SESSION['user']['role'] === 'admin')
    ) {
        Comment::delete($id);
    }

    header("Location: " . BASE_URL . "index.php?url=article/detail/" . $comment['article_id']);
}

}
