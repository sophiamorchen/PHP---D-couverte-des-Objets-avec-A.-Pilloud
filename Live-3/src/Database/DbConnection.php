<?php
namespace App\Database;
use PDO;

class DbConnection
{
    private static $instance = null;


    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=cours;port=3306', 'root', '');
    }
    public static function getInstance(): DbConnection
    {
        return self::createInstance();
    }
    public static function getPDO(): PDO
    {
        return self::createInstance()->pdo;
    }
    public static function createInstance() {
        if (self::$instance == null){
            static::$instance = new DbConnection();
        }
        return self::$instance;

    }
}