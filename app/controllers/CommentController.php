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

    public function edit($id) {
    $comment = Comment::findById($id);

    if (!$comment) {
        die("Komentář nenalezen.");
    }

    if (
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

public function delete($id) {
    $comment = Comment::findById($id);

    if (!$comment) {
        die("Komentář nenalezen.");
    }

    if (
        isset($_SESSION['user']) &&
        ($_SESSION['user']['id'] === $comment['user_id'] || $_SESSION['user']['role'] === 'admin')
    ) {
        Comment::delete($id);
    }

    header("Location: " . BASE_URL . "index.php?url=article/detail/" . $comment['article_id']);
}

}
