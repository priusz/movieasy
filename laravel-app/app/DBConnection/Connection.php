<?php

namespace App\DBConnection;
use PDO;
use PDOException;

class Connection
{
    private static ?PDO $pdo = null;

    public function __construct() {
        $this->connect();
    }

    public static function connect(): PDO {
        if (self::$pdo == null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
            try {
                self::$pdo = new PDO($dsn, $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
