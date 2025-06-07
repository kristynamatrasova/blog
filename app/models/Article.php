<?php
class Article extends Model {
    public static function all() {
        return self::query("SELECT a.*, u.username FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC");
    }

    public static function find($id) {
        return self::queryOne("SELECT * FROM articles WHERE id = ?", [$id]);
    }

    public static function create($user_id, $title, $content) {
        self::execute("INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)", [$user_id, $title, $content]);
    }

    public static function update($id, $title, $content) {
        self::execute("UPDATE articles SET title = ?, content = ?, updated_at = NOW() WHERE id = ?", [$title, $content, $id]);
    }

    public static function delete($id) {
        self::execute("DELETE FROM articles WHERE id = ?", [$id]);
    }
}
