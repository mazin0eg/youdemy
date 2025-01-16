<?php

class Database {
    private $host = 'localhost'; // Database host
    private $dbname = 'youdemy'; // Database name
    private $username = 'root'; // Database username
    private $password = '1234'; // Database password
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
