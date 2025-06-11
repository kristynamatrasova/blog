<?php
class User extends Model {
    
    //načtení uživatele podle jména
    public static function findByUsername($username) {
        return self::queryOne("SELECT * FROM users WHERE username = ?", [$username]);
    }

    //registrace nového uživatele
    public static function create($username, $email, $password) {
        self::execute("INSERT INTO users (username, email, password) VALUES (?, ?, ?)", [$username, $email, $password]);
    }

    //načtení uživatele posle ID - získání dat na základně SESSIOM
    public static function findById($id) {
        return self::queryOne("SELECT * FROM users WHERE id = ?", [$id]);
    }

    //změna hesla
    public static function updatePassword($id, $password) {
        self::execute("UPDATE users SET password = ? WHERE id = ?", [$password, $id]);
    }
}
