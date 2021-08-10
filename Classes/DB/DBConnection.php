<?php

namespace DB;

use PDO;

class DBConnection
{

    private static $instance = null;

    private static $host = 'localhost';
    private static $user = 'root';
    private static $pwd = '';
    private static $dbName = 'php-mvc-mysql';

    private static $dsn;
    private static $pdo;

    private function __construct()
    {
        self::$dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName;
        self::$pdo = new PDO(self::$dsn, self::$user, self::$pwd);
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DBConnection();
        }

        return self::$instance;
    }

    public static function connect()
    {
        return self::$pdo;
    }

}