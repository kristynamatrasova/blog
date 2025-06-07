<?php
class CommentController extends Controller {
    public function create($article_id) {
        if (!isset($_SESSION['user'])) exit('Přihlášení nutné.');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Comment::create($_SESSION['user']['id'], $article_id, $_POST['content']);
            header("Location: /article/detail/$article_id");
        }
    }
}
