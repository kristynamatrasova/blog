<?php
class User extends Model {
    public static function findByUsername($username) {
        return self::queryOne("SELECT * FROM users WHERE username = ?", [$username]);
    }

    public static function create($username, $email, $password) {
        self::execute("INSERT INTO users (username, email, password) VALUES (?, ?, ?)", [$username, $email, $password]);
    }

    public static function findById($id) {
        return self::queryOne("SELECT * FROM users WHERE id = ?", [$id]);
    }

    public static function updatePassword($id, $password) {
        self::execute("UPDATE users SET password = ? WHERE id = ?", [$password, $id]);
    }
}
