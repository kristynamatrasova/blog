<?php
class Comment extends Model {
    public static function findByArticle($article_id) {
        return self::query("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE article_id = ? ORDER BY c.created_at DESC", [$article_id]);
    }

    public static function create($user_id, $article_id, $content) {
        self::execute("INSERT INTO comments (user_id, article_id, content) VALUES (?, ?, ?)", [$user_id, $article_id, $content]);
    }
}
