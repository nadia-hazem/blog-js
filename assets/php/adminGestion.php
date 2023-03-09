<?php
SESSION_START();
require_once '../class/DbConnect.php';
require_once '../class/User.php';
require_once '../class/Article.php';
require_once '../class/Comment.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);


// récupération des utilisateurs
if (isset($_GET['users'])) {
    $users = $user->getUsers();
    echo json_encode($users);
}

// suppression d'un user
if (isset($_GET['deleteUser'])) {
    $id = $_GET['deleteUser'];
    $user->deleteUser($id);
}

// changer les droits d'un user
if (isset($_GET['changeDroit'])) {
    $id = $_GET['changeDroit'];
    $droit = $_GET['droit'];
    $user->changeDroit($id, $droit);
}

// récupération des articles
if (isset($_GET['articles'])) {
    // $articles = $article->getArticles();
    echo json_encode($articles);
}
