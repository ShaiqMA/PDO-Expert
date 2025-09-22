<?php
require "db.php";

class Product {
    private $dbh;

    public function __construct() {
        $this->dbh = new DB();
    }

    public function insertProduct(string $omschrijving, string $foto, float $prijsPerStuk): PDOStatement|false {
        return $this->dbh->run(
            "INSERT INTO product (omschrijving, foto, prijsPerStuk) 
             VALUES (:omschrijving, :foto, :prijsPerStuk)", 
            [
                ":omschrijving" => $omschrijving,
                ":foto" => $foto,
                ":prijsPerStuk" => $prijsPerStuk
            ]
        );
    }
}
