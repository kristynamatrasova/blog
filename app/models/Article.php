<?php
class Article extends Model {
    public static function all() {
        return self::query("SELECT a.*, u.username FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC");
    }

    public static function find($id) {
        return self::queryOne("SELECT a.*, u.username FROM articles a JOIN users u ON a.user_id = u.id WHERE a.id = ?", [$id]);
    }

   public static function create($title, $content, $userId) {
    self::execute(
        "INSERT INTO articles (title, content, user_id) VALUES (?, ?, ?)",
        [$title, $content, $userId]
    );
}


    public static function update($id, $title, $content) {
        self::execute("UPDATE articles SET title = ?, content = ?, updated_at = NOW() WHERE id = ?", [$title, $content, $id]);
    }

    public static function delete($id) {
        self::execute("DELETE FROM articles WHERE id = ?", [$id]);
    }
    public static function findByUser($user_id) {
    return self::query("SELECT * FROM articles WHERE user_id = ? ORDER BY created_at DESC", [$user_id]);
}

}
