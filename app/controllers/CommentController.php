<?php
class CommentController extends Controller {
    public function create($article_id) {
        if (!isset($_SESSION['user'])) {
            header("Location: /blog/public/index.php?url=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Comment::create($_SESSION['user']['id'], $article_id, $_POST['content']);
        }

        header("Location: /blog/public/index.php?url=article/detail/$article_id");
    }
}
