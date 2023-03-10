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
    public function createArticle($title, $description, $continent, $image)
    {
        // html special char
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $continent = htmlspecialchars($continent);

        // générer summary
        $summary = $this->createSummary($description);

        // requete
        $request = "INSERT INTO articles (titre, description, continent, date, id_utilisateur, image, summary) VALUES (:title, :description, :continent, NOW(), :id_utilisateur,:image, :summary)";
                    $insert = $this->bdd->prepare($request);

                    $insert->execute([
                        'title' => $title,
                        'description' => $description,
                        'continent' => $continent,
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
            var_dump($article);
        }
    }

    // récupération de tous les articles
    function getAllArticles($start_index = 0, $count = 5) {
        // requete
        $request = "SELECT articles.*, utilisateurs.login AS auteur, articles.summary FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id ORDER BY date DESC";
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

    //fonction pour récupérer la colonne description
    function getDescription() {
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
    function createSummary($description) {
        if (is_string($description)) {
            $summary = substr(strip_tags($description), 0, 150);
            $summary .= '...';
            return $summary;
        } else {
            return '';
        }
    }
    
}
?>
