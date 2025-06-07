<?php
class Comment extends Model {
    public static function findByArticle($article_id) {
        return self::query("
            SELECT c.*, u.username
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.article_id = ?
            ORDER BY c.created_at DESC
        ", [$article_id]);
    }

    public static function create($user_id, $article_id, $content) {
        self::execute("INSERT INTO comments (user_id, article_id, content) VALUES (?, ?, ?)", [$user_id, $article_id, $content]);
    }
   
    public static function findByUser($user_id) {
    return self::query("
        SELECT c.*, a.title FROM comments c 
        JOIN articles a ON c.article_id = a.id 
        WHERE c.user_id = ? 
        ORDER BY c.created_at DESC
    ", [$user_id]);
}

}

