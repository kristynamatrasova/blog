<?php
class ArticleController extends Controller {
    public function index() {
        $articles = Article::all();
        require 'app/views/article/index.php';
    }

    public function detail($id) {
        $article = Article::find($id);
        $comments = Comment::findByArticle($id);
        require 'app/views/article/detail.php';
    }

    public function create() {
        if (!isset($_SESSION['user'])) exit("Přihlášení nutné.");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Article::create($_SESSION['user']['id'], $_POST['title'], $_POST['content']);
            header('Location: /article/index');
        }
        require 'app/views/article/create.php';
    }

    public function edit($id) {
        $article = Article::find($id);
        if ($_SESSION['user']['id'] !== $article['user_id'] && $_SESSION['user']['role'] !== 'admin') die("Nepovolený přístup");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Article::update($id, $_POST['title'], $_POST['content']);
            header("Location: /article/detail/$id");
        }
        require 'app/views/article/edit.php';
    }

    public function delete($id) {
        $article = Article::find($id);
        if ($_SESSION['user']['id'] === $article['user_id'] || $_SESSION['user']['role'] === 'admin') {
            Article::delete($id);
        }
        header('Location: /article/index');
    }
}
