<?php
class Article extends Model { //Model-datová třída, práce s daty (CRUD operace)
    
    //výpis všech článků
    public static function all() {
        return self::query("SELECT a.*, u.username FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC");
    }

    //načtení jednoho článku podle ID
    public static function find($id) {
        return self::queryOne("SELECT a.*, u.username FROM articles a JOIN users u ON a.user_id = u.id WHERE a.id = ?", [$id]);
    }

   //vytvoření nového článku - pouze vložení do databáze
    public static function create($title, $content, $userId) {
    self::execute(
        "INSERT INTO articles (title, content, user_id) VALUES (?, ?, ?)",
        [$title, $content, $userId]
    );
}

    //úprava článků, podle ID
    public static function update($id, $title, $content) {
        self::execute("UPDATE articles SET title = ?, content = ?, updated_at = NOW() WHERE id = ?", [$title, $content, $id]);
    }

    //smazání článků, podle ID
    public static function delete($id) {
        self::execute("DELETE FROM articles WHERE id = ?", [$id]);
    }
    
    //příspěvky jednoho uživatele, seřazeno od nejnovějšího
    public static function findByUser($user_id) {
    return self::query("SELECT * FROM articles WHERE user_id = ? ORDER BY created_at DESC", [$user_id]);
}

//příspěvky všech uživatelů, ne admin
public static function findAllUserArticles() {
    return self::query("
        SELECT a.*, u.username 
        FROM articles a 
        JOIN users u ON a.user_id = u.id
        WHERE u.role = 'user'
        ORDER BY a.created_at DESC
    ");
}


}
