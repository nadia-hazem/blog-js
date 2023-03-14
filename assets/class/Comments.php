<?php

class Comments
{
    private $id;
    public $login;
    private $password;
    private $bdd;

    
    public function __construct(DbConnect $bdd)
    {
        /* $this->bdd = $bdd; */
        $this->bdd = $bdd->getbdd();

        if (isset($_SESSION['user'])) {
            $this->id = $_SESSION['user']['id'];
            $this->login = $_SESSION['user']['login'];
            $this->password = $_SESSION['user']['password'];
        }
    }
    
    // fonction pour récupérer tous les commentaires
    public function getComments($id)
    {

        $request = "SELECT commentaires.*, DATE_FORMAT(commentaires.date, '- %d %m %Y %H:%i -') as date, utilisateurs.login AS auteur FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id WHERE commentaires.id_article = :id ORDER BY date DESC";
        // requete
        $select = $this->bdd->prepare($request);
        // execution avec liaison des params
        $select->execute([
            'id' => $id,
        ]);

        // récupération des résultats
        $comments = $select->fetchAll(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$comments) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $comments;
        }
    }

    // fonction pour récupérer un commentaire en particulier
    public function getComment($id)
    {
        $this->bdd->query('SELECT * FROM commentaires WHERE id = :id');
        $request = "SELECT commentaires.*, DATE_FORMAT(commentaires.created_at, '%d %m %Y - %H:%i') as date, utilisateurs.login AS auteur FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id WHERE commentaires.id = :id ORDER BY date DESC";
        // requete
        $select = $this->bdd->prepare($request);
        // execution avec liaison des params
        $select->execute([
            'id' => $id,
        ]);

        // récupération des résultats
        $comment = $select->fetch(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$comment) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $comment;
        }
    }

    // création d'un commentaire lié à l'id de l'article et à l'id de l'utilisateur qui le crée
    public function addComment($sujet, $commentaire, $id_article, $id_utilisateur)
    {
        // html special char
        $sujet = htmlspecialchars($sujet);
        $commentaire = htmlspecialchars($commentaire);
        $id_utilisateur = htmlspecialchars($id_utilisateur);
        $id_article = htmlspecialchars($id_article);

        // requete
        $request = "INSERT INTO commentaires (sujet, commentaire, date, id_utilisateur, id_article) VALUES (:sujet, :commentaire, NOW(), :id_utilisateur, :id_article)";

        $insert = $this->bdd->prepare($request);

        // execution avec liaisons des param
        $insert->execute([
            'sujet' => $sujet,
            'commentaire' => $commentaire,
            'id_utilisateur' => $id_utilisateur,
            'id_article' => $id_article,
        ]);

        // echo "ok" si la requete s'est bien passée
        if ($insert) {
            echo "ok";
        } else {
            echo "erreur";
        }
        $this->bdd = null;
    } 

    // fonction pour supprimer un commentaire
    public function deleteComment($id)
    {
        // requête
        $request = "DELETE FROM commentaires WHERE id = :id";

        $delete = $this->bdd->prepare($request);
        // execution avec liaisons des param
        $delete->execute([
            'id' => $id
        ]);

        // echo "ok" si la requête s'est bien passée
        if ($delete) {
            echo "ok";
        } else {
            echo "erreur";
        }
    }
}

?>