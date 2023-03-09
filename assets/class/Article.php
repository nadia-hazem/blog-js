<?php

class Article
{
    // propriétés
    private $bdd;

    // constructeur
    public function __construct(DbConnect $db)
    {
        $this->bdd = $db->getBdd();
    }

    // création d'un article
    public function createArticle($article)
    {
        // html special char
        $article = htmlspecialchars($article);

        // requete
        $request = "INSERT INTO articles (article) VALUES (:article)";

        $insert = $this->bdd->prepare($request);

        // execution avec liaisons des param
        $insert->execute([
            'article' => $article
        ]);

        // echo "ok" si la requête s'est bien passée
        if ($insert) {
            echo "ok";
        }

        // fermeture de la co a la bdd
        $this->bdd = null;
    }

    // suppression d'un article
    public function deleteArticle($id)
    {
        // html special char
        $id = htmlspecialchars($id);

        // requete
        $request = "DELETE FROM articles WHERE id = :id";

        $delete = $this->bdd->prepare($request);

        // execution avec liaisons des param
        $delete->execute([
            'id' => $id
        ]);

        // echo "ok" si la requête s'est bien passée
        if ($delete) {
            echo "ok";
        }

        // fermeture de la co a la bdd
        $this->bdd = null;
    }
}
