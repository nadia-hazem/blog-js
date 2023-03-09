<?php

class Comment
{

    // propriétés
    private $db;

    // création d'un commentaire lié à l'id de l'article et à l'id de l'utilisateur qui le crée
    public function createComment($text, $id_utilisateur, $id_article)
    {
        // html special char
        $text = htmlspecialchars($text);
        $id_utilisateur = htmlspecialchars($id_utilisateur);
        $id_article = htmlspecialchars($id_article);

        // requete
        $request = "INSERT INTO commentaires (text, id_utilisateur, id_article) VALUES (:text, :id_utilisateur, :id_article)";

        $insert = $this->db->prepare($request);

        // execution avec liaisons des param
        $insert->execute([
            'text' => $text,
            'id_utilisateur' => $id_utilisateur,
            'id_article' => $id_article
        ]);

        // echo "ok" si la requête s'est bien passée
        if ($insert) {
            echo "ok";
        }

        // fermeture de la co a la bdd
        $this->db = null;
    }
}
