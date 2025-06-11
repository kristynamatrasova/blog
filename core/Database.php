<?php
class Database {
    protected static $pdo; // Statická proměnná pro uložení PDO instance – umožňuje znovupoužít připojení v celé aplikaci (singleton pattern)

    // Naváže připojení k databázi pomocí PDO, pokud ještě není připojeno
    public static function connect() {
        if (!self::$pdo) {
             // Vytvoření nové PDO instance s DSN (Data Source Name)
            self::$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            // Nastaví režim vyhazování výjimek při chybě
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    // Provede SELECT dotaz, vrací všechny výsledky jako asociativní pole
    public static function query($sql, $params = []) {
        $stmt = self::connect()->prepare($sql); //připraví dotaz
        $stmt->execute($params); //spustí dotaz s parametry
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //vrátí všechny řádky
    }

    // Provede SELECT dotaz, vrací pouze jeden řádek jako asociativní pole
    public static function queryOne($sql, $params = []) {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Provede INSERT, UPDATE nebo DELETE – dotaz bez návratu dat
    public static function execute($sql, $params = []) {
        $stmt = self::connect()->prepare($sql);
        return $stmt->execute($params);
    }
}
