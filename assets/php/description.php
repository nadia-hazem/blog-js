<?php
session_start();
require_once '../class/DbConnect.php';
require_once '../class/Article.php';

$db = new DbConnect();
$article = new Article($db);

// récup de la description
if (isset($_GET['desc'])) {
    $id = $_GET['desc'];
    $item = $article->getArticle($id);
    $description = $item['description'];
    echo $description;
}
