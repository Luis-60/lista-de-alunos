<?php
namespace app\database;
use PDO;

class Connection {
    private static $pdoInstance = null;

    public static function getConnection()
    {
        if (empty(self::$pdoInstance)) {
            self::$pdoInstance = new PDO(
                "mysql:host=mysql;dbname=app_db",
                "user",
                "secret",
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // boa prática: mostrar erros PDO
                ]
            );
        }
        return self::$pdoInstance;
    }
}

$pdo = Connection::getConnection();