<?php
class User extends Model {
    
    //načtení uživatele podle jména
    public static function findByUsername($username) {
        return self::queryOne("SELECT * FROM users WHERE username = ?", [$username]);
    }

    //registrace nového uživatele
    public static function create($username, $email = null, $password) {
        self::execute("INSERT INTO users (username, email, password) VALUES (?, ?, ?)", [$username, $email, $password]);
    }

    //načtení uživatele posle ID - získání dat na základně SESSIOM
    public static function findById($id) {
        return self::queryOne("SELECT * FROM users WHERE id = ?", [$id]);
    }

   
}
