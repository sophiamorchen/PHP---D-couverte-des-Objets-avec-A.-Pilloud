<?php

class DbConnection
{
    private static $instance = null;
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=cours;port=3306', 'root', '');
    }
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            var_dump('test');
        self::$instance = new DbConnection();
        }
        return self::$instance;
    }
    public function getPDO()
    {
        return $this->pdo;
    }
}