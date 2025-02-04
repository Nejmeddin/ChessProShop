<?php
include "config\App.php";
class Database
{
    private static $instance = null;
    private $pdo;
    private function __construct()
    {
        // Private constructor to prevent direct instantiation
        try {
            $this->pdo = new

                PDO(
                "mysql:host=" . App::DB_HOST . ";dbname=" . App::DB_NAME . "",
                App::DB_USER,
                App::DB_PASS
            );

            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,

                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(); //new Database();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->pdo;
    }
}
?>