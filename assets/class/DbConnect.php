<?php

class DbConnect {
    private $bdd;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'thomas-spinec_blog';
        $dbuser = 'adminbdd';
        $dbpass = 'basededonnees';

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
