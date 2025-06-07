<?php
class ArticleController extends Controller {

    // Výpis všech článků
    public function index() {
        $articles = Article::all();
        $this->view('article/index', ['articles' => $articles]);
    }

    // Detail jednoho článku
    public function detail($id) {
        $article = Article::find($id);
        if (!$article) {
            die("Článek nenalezen.");
        }

        $this->view('article/detail', ['article' => $article]);
    }

    // Vytvoření nového článku
    public function create() {
        if (!isset($_SESSION['user'])) {
            header("Location: /blog/public/index.php?url=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Article::create($_SESSION['user']['id'], $_POST['title'], $_POST['content']);
            header("Location: /blog/public/index.php?url=article/index");
            exit;
        }

        $this->view('article/create');
    }

    // Úprava článku
    public function edit($id) {
        $article = Article::find($id);
        if (!$article) {
            die("Článek nenalezen.");
        }

        // Povolení jen autorovi nebo adminovi
        if ($_SESSION['user']['id'] !== $article['user_id'] && $_SESSION['user']['role'] !== 'admin') {
            die("Nemáš oprávnění upravit tento článek.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Article::update($id, $_POST['title'], $_POST['content']);
            header("Location: /blog/public/index.php?url=article/detail/$id");
            exit;
        }

        $this->view('article/edit', ['article' => $article]);
    }

    // Smazání článku
    public function delete($id) {
        $article = Article::find($id);
        if (!$article) {
            die("Článek nenalezen.");
        }

        if ($_SESSION['user']['id'] === $article['user_id'] || $_SESSION['user']['role'] === 'admin') {
            Article::delete($id);
        }

        header("Location: /blog/public/index.php?url=article/index");
    }
}
