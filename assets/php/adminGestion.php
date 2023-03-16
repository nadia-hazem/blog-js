<?php
SESSION_START();
require_once '../class/DbConnect.php';
require_once '../class/User.php';
require_once '../class/Article.php';
require_once '../class/Comments.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$comment = new Comments($db);


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
    $articles = $article->getAllArticles();
    echo json_encode($articles);
}

// suppression d'un article
if (isset($_GET['deleteArticle'])) {
    $id = $_GET['deleteArticle'];
    $article->deleteArticle($id);
}

// récupération d'un article à modifier
if (isset($_GET["modifArticle"])) {
    $id = $_GET["modifArticle"];
    $article = $article->getArticle($id);
    echo json_encode($article);
}

// update d'un article
if (isset($_GET['updateArticle'])) {
    $id = $_GET['updateArticle'];
    $title = $_POST['titre'];
    $description = $_POST['description'];
    if (isset($_POST['image'])) {
        $image = $_POST['image'];
    } else {
        $image = null;
    }
    $article->updateArticle($id, $title, $description, $image);
}

// récupération des commentaires d'un article
if (isset($_GET['showComments'])) {
    $id = $_GET['showComments'];
    $comments = $comment->getComments($id);
    if ($comments !== null) {
        echo json_encode($comments);
    } else {
        echo json_encode('noComments');
    }
}

// suppression d'un commentaire
if (isset($_GET['deleteComment'])) {
    $id = $_GET['deleteComment'];
    $comment->deleteComment($id);
}

// récupération d'un commentaire à modifier
if (isset($_GET["modifComment"])) {
    $id = $_GET["modifComment"];
    $comment = $comment->getComment($id);
    echo json_encode($comment);
}

// update d'un commentaire
if (isset($_GET['updateComment'])) {
    $id = $_GET['updateComment'];
    $sujet = $_POST['sujet'];
    $commentaire = $_POST['commentaire'];
    $comment->updateComment($id, $sujet, $commentaire);
}

// récupération des catégories
if (isset($_GET['showCategories'])) {
    $categories = $article->getCategories();
    echo json_encode($categories);
}

// suppression d'une catégorie
if (isset($_GET['deleteCategory'])) {
    $id = $_GET['deleteCategory'];
    $article->deleteCategory($id);
}

// récupération d'une catégorie à modifier
if (isset($_GET["modifCategory"])) {
    $id = $_GET["modifCategory"];
    $category = $article->getCategory($id);
    echo json_encode($category);
}

// update d'une catégorie
if (isset($_GET['updateCategory'])) {
    $id = $_GET['updateCategory'];
    $category = $_POST['category'];
    $article->updateCategory($id, $category);
}

// création d'une catégorie
if (isset($_GET['addCategorie'])) {
    $category = $_POST['category'];
    $article->addCategory($category);
}
