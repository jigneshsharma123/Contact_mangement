<?php

namespace JigneshSharma\New\Database;

use PDO;
use PDOException;

class DatabaseFactory {
    private static $pdo;

    public static function createConnection() {
        if (!self::$pdo) {
            $host = 'localhost';
            $dbname = 'contact_manager';
            $user = 'root';
            $pass = 'root';

            try {
                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
