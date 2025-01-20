<?php

class Database {
    private $host = 'localhost'; 
    private $dbname = 'youdemy'; 
    private $username = 'root'; 
    private $password = '1234'; 
    private $pdo;

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            return $this->pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
