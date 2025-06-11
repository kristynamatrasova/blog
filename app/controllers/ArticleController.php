<?php
class ArticleController extends Controller {

    // Výpis všech článků
    public function index() {
        $articles = Article::all(); //získání dat z modelu Article
        $this->view('article/index', ['articles' => $articles]); //předání dat do šablony
    }

    // Detail jednoho článku
    public function detail($id) {
        $article = Article::find($id); //načtení článku posle ID
        if (!$article) {
            die("Článek nenalezen."); //neexistuje - ukončí skript
        }

        $this->view('article/detail', ['article' => $article]); //předá článek do šablony
    }

    // Vytvoření nového článku
    public function create() {
    if (!isset($_SESSION['user'])) { //kontroluje, zda je uživatel přihlášen
        header("Location: " . BASE_URL . "index.php?url=auth/login"); //pokud ne, přesměruje na login
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title']); //získá název
        $content = trim($_POST['content']); //získá obsah

        if (empty($title) || empty($content)) {
            die("Název a obsah jsou povinné.");
        }

        Article::create($title, $content, $_SESSION['user']['id']); //vytvoří se nový příspěvek

        header("Location: " . BASE_URL . "index.php?url=article/index");
        exit;
    }

    $this->view('article/create'); //při get zobraví formulář
}


    // Úprava článku
    public function edit($id) { //zjistí, jestli článek s daným ID existuje
        $article = Article::find($id);
        if (!$article) {
            die("Článek nenalezen.");
        }

        // Povolení jen autorovi nebo adminovi
        if ($_SESSION['user']['id'] !== $article['user_id'] && $_SESSION['user']['role'] !== 'admin') {
            die("Nemáš oprávnění upravit tento článek.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Article::update($id, $_POST['title'], $_POST['content']); //aktualizace příspěvku
            header("Location: /blog/public/index.php?url=article/detail/$id"); //přesměruje na detail
            exit;
        }

        $this->view('article/edit', ['article' => $article]); //zobrazí formulář pro editaci
    }

    // Smazání článku
    public function delete($id) {
        $article = Article::find($id);
        if (!$article) {
            die("Článek nenalezen.");
        }

        if ($_SESSION['user']['id'] === $article['user_id'] || $_SESSION['user']['role'] === 'admin') {
            Article::delete($id); //smaže se příspěvek, pokud má právo
        }

        header("Location: /blog/public/index.php?url=article/index"); 
    }

    //Články aktuálního uživaltele
    public function userPosts() {
    $articles = Article::findAllUserArticles(); //získá všechny jeho články
    $this->view('article/user_posts', ['articles' => $articles]); //zobrazí je
}


}
