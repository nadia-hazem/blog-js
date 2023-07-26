<?php

class DbConnect {
    private $bdd;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'fqdbhzuh_blog';
        $dbuser = 'fqdbhzuh_n0NAq79EJ';
        $dbpass = 'tNvTEkztxMnhMWtURtBHPvB5EHROYGBf';

        try {
            $this->bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

    public function getBdd() {
        return $this->bdd;
    }
}

?>