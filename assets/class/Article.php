<?php
include_once 'DbConnect.php';

class Article
{
    private $id;
    public $login;
    private $password;
    private $bdd;



    public function __construct(DbConnect $db)
    {
        $this->bdd = $db->getbdd();

        if (isset($_SESSION['user'])) {
            $this->id = $_SESSION['user']['id'];
            $this->login = $_SESSION['user']['login'];
            $this->password = $_SESSION['user']['password'];
        }
    }

    // création d'un article
    public function createArticle($title, $description, $categories, $image)
    {
        // html special chars
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $categories = htmlspecialchars($categories);

        // générer summary
        $summary = $this->createSummary($description);

        // requete
        $request = "INSERT INTO articles (titre, description, categories, date, id_utilisateur, image, summary) VALUES (:title, :description, :categories, NOW(), :id_utilisateur,:image, :summary)";

        $insert = $this->bdd->prepare($request);

        $insert->execute([
            'title' => $title,
            'description' => $description,
            'categories' => $categories,
            'id_utilisateur' => $this->id,
            'image' => $image,
            'summary' => $summary
        ]);


        // echo "ok" si la requête s'est bien passée
        if ($insert) {
            return "ok";
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
    // récupération d'un article
    function getArticle($id)
    {
        // html special char
        $id = htmlspecialchars($id);

        // requete
        $request = "SELECT articles.*, utilisateurs.login AS auteur FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id WHERE articles.id = :id";
        $select = $this->bdd->prepare($request);
        // execution avec liaison des params
        $select->execute([
            'id' => $id
        ]);

        // récupération des résultats
        $article = $select->fetch(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$article) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $article;
        }
    }

    // récupération de tous les articles
    public function getAllArticles()
    {
        // requete
        $request = "SELECT articles.*, DATE_FORMAT(articles.date, '%d/%m/%Y %H-%i') as date, utilisateurs.login AS auteur, articles.summary 
        FROM articles 
        INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id 
        ORDER BY date DESC";

        $select = $this->bdd->prepare($request);
        // execution
        $select->execute();
        // récupération des résultats
        $articles = $select->fetchAll(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$articles) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $articles;
        }
    }


    public function getArticlesPerPage($start_index, $num_articles)
    {
        $query = "SELECT articles.*, DATE_FORMAT(articles.date, '%d/%m/%Y %H-%i') as date, utilisateurs.login AS auteur, articles.summary 
        FROM articles 
        INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id 
        ORDER BY date DESC 
        LIMIT $start_index, $num_articles
        ";
        $result = $this->bdd->query($query);
        $articles = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $description = $row['description'];
            $row['summary'] = $this->createSummary($description);
            $articles[] = $row;
        }
        return $articles;
    }

    //fonction pour récupérer la colonne description
    public function getDescription() {
        $request = "SELECT description FROM articles";
        $select = $this->bdd->prepare($request);
        $select->execute();
        $description = $select->fetchAll(PDO::FETCH_ASSOC);
        if (!$description) {
            return null;
        } else {
            return $description;
        }
    }

    // fonction pour générer le résumé
    public function createSummary($description) {

        if (is_string($description)) {
            $summary = substr(strip_tags($description), 0, 150);
            $summary .= '...';
            return $summary;
        } else {
            return '';
        }
    }

    // update d'un article
    public function updateArticle($id, $title, $description, $image)
    {
        // html special char
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $id = htmlspecialchars($id);
        // si l'image est nulle, on ne change pas cette colonne, et l'array ne contient pas la clé image
        if ($image == null) {
            $request = "UPDATE articles SET titre = :title, description = :description WHERE id = :id";
            // array
            $array = [
                'title' => $title,
                'description' => $description,
                'id' => $id
            ];
        } else {
            $image = htmlspecialchars($image);

            $request = "UPDATE articles SET titre = :title, description = :description, image = :image WHERE id = :id";
            // array
            $array = [
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'id' => $id
            ];
        }

        // requete
        $update = $this->bdd->prepare($request);

        // execution avec liaisons des param
        $update->execute($array);

        // echo "ok" si la requête s'est bien passée
        if ($update) {
            echo "ok";
        }

        // fermeture de la co a la bdd
        $this->bdd = null;
    }
}
