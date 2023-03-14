<?php
session_start();
require_once '../class/DbConnect.php';
require_once '../class/User.php';
require_once '../class/Article.php';
require_once '../class/Comments.php';
$db = new DbConnect();
$user = new User($db);
$comment = new Comments($db);

    if ($user->isConnected()) {
        $id_utilisateur = $user->getId();
    } else {
        // utilisateur non connecté, afficher un message d'erreur ou rediriger vers une page de connexion
        header('Location: ../../forms.php?choice=login');
    }

    if (isset($_POST['submit']) && $_POST['submit']=='Signer') {

        // Récupérer les données du formulaire
        $sujet = $_POST['sujet'];
        $commentaire = $_POST['commentaire'];
        $id_article = $_POST['id_article'];
        // Insérer le commentaire dans la base de données
        $commentaire = $comment->addComment($sujet, $commentaire, $id_article, $id_utilisateur);
        // Rediriger l'utilisateur vers l'article
        header('Location: ../../article.php?id=' . $id_article);
        exit();
    }
?>