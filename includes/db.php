<?php
class DB {
    protected $pdo;
    public function __construct($db = "winkel", $user="root", $pwd="", $host="localhost") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch(PDOException $e) {
            die("Connection failed: ") . $e->getMessage();
        }
    }
       public function Run($sql, $placeholders = null) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }
}















?>