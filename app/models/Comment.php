<?php
class Comment extends Model {
    
    //komentáře k příspěvku
    public static function findByArticle($article_id) {
        return self::query("
            SELECT c.*, u.username
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.article_id = ?
            ORDER BY c.created_at DESC
        ", [$article_id]);
    }

    //vytvoření komentáře
    public static function create($user_id, $article_id, $content) {
        self::execute("INSERT INTO comments (user_id, article_id, content) VALUES (?, ?, ?)", [$user_id, $article_id, $content]);
    }
   
    //komentář konkrétního uživatele
    public static function findByUser($user_id) {
    return self::query("
        SELECT c.*, a.title FROM comments c 
        JOIN articles a ON c.article_id = a.id 
        WHERE c.user_id = ? 
        ORDER BY c.created_at DESC
    ", [$user_id]);
}

//načtení komentáře podle ID
public static function findById($id) {
    return self::queryOne("SELECT * FROM comments WHERE id = ?", [$id]);
}

//úprava komentáře
public static function update($id, $content) {
    self::execute("UPDATE comments SET content = ? WHERE id = ?", [$content, $id]);
}

//smazání komentáře podle ID
public static function delete($id) {
    self::execute("DELETE FROM comments WHERE id = ?", [$id]);
}


}

