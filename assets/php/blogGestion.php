<?php
session_start();
require_once '../class/DbConnect.php';
require_once '../class/Article.php';
$db = new DbConnect();
$article = new Article($db);


if (isset($_GET['categ'])) {
    $_SESSION['categInt'] = $_GET['categ'];
    echo $_SESSION['categInt'];
}

if (isset($_GET['value'])) {
    if (!isset($_SESSION['categInt'])) {
        $_SESSION['categInt'] = 0;
    }
    $Categ = $article->getCategories();

    // création d'un json avec la valeur de la variable $Categ et la valeur de la variable $_SESSION['categInt']
    $json = json_encode(array('Categ' => $Categ, 'categInt' => $_SESSION['categInt']));
    echo $json;
}
