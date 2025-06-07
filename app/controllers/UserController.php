<?php
class UserController extends Controller {

    public function profile() {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "index.php?url=auth/login");
            exit;
        }

        $user = User::findById($_SESSION['user']['id']);
        $this->view('user/profile', ['user' => $user]);
    }

    public function myPosts() {
        $articles = Article::findByUser($_SESSION['user']['id']);
        $this->view('user/my_posts', ['articles' => $articles]);
    }

    public function myComments() {
        $comments = Comment::findByUser($_SESSION['user']['id']);
        $this->view('user/my_comments', ['comments' => $comments]);
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
            User::updatePassword($_SESSION['user']['id'], $newPassword);
            echo "Heslo změněno.";
            exit;
        }

        $this->view('user/change_password');
    }
}
