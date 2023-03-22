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
        // requete pour récupérer l'image
        $request = "SELECT image FROM articles WHERE id = :id";
        $select = $this->bdd->prepare($request);
        $select->execute([
            'id' => $id
        ]);
        $image = $select->fetch(PDO::FETCH_ASSOC);
        // suppression de l'image
        if (unlink('../uploads/' . $image['image'])) {
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
        } else {
            echo "error";
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
        $request = "SELECT articles.*, DATE_FORMAT(articles.date, '- %d %b %Y à %H:%i -') as date, utilisateurs.login AS auteur, categories.categorie as categ, articles.summary 
        FROM articles 
        INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.categories = categories.id
        WHERE articles.id = :id";

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
        $request = "SELECT articles.*, DATE_FORMAT(articles.date, '- %d %b %Y à %H:%i -') as date, utilisateurs.login AS auteur, categories.categorie as categ, articles.summary 
        FROM articles 
        INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.categories = categories.id ORDER BY date DESC";

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

    // compter le nombre d'article par catégorie
    public function countArticlesByCategory($category)
    {
        // html special char
        $category = htmlspecialchars($category);

        // requete
        $request = "SELECT COUNT(*) as nb_articles FROM articles WHERE categories = :category";

        $select = $this->bdd->prepare($request);
        // execution avec liaison des params
        $select->execute([
            'category' => $category
        ]);

        // récupération des résultats
        $nb_articles = $select->fetch(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$nb_articles) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $nb_articles;
        }
    }


    public function getArticlesPerPage($start_index, $num_articles, $category)
    {
        $query =
            "SELECT articles.*, DATE_FORMAT(articles.date, '- %d %b %Y à %H:%i -') as date, utilisateurs.login AS auteur, categories.categorie as categ, articles.summary 
            FROM articles 
            INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.categories = categories.id ORDER BY date DESC 
            LIMIT $start_index, $num_articles
            ";

        if ($category == 0) {
            // preparation
            $result = $this->bdd->prepare($query);
            // execution avec liaison des paramètres
            $result->execute();
        } else {
            $query =
                "SELECT articles.*, DATE_FORMAT(articles.date, '- %d %b %Y à %H:%i -') as date, utilisateurs.login AS auteur, categories.categorie as categ, articles.summary 
                FROM articles 
                INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.categories = categories.id WHERE categories.id = :category ORDER BY date DESC 
                LIMIT $start_index, $num_articles
                ";
            // preparation
            $result = $this->bdd->prepare($query);
            // execution avec liaison des paramètres
            $result->execute([
                'category' => $category
            ]);
        }

        $articles = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $description = $row['description'];
            $row['summary'] = $this->createSummary($description);
            $articles[] = $row;
        }
        return $articles;
    }

    //fonction pour récupérer la colonne description
    public function getDescription()
    {
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
    public function createSummary($description)
    {

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

    // récupération des catégories
    public function getCategories()
    {
        // requête
        $request = "SELECT * FROM categories";
        $select = $this->bdd->prepare($request);
        // execution
        $select->execute();
        // récupération des résultats
        $categories = $select->fetchAll(PDO::FETCH_ASSOC);
        // Si $result produit une erreur, on retourne null
        if (!$categories) {
            return null;
        } else {
            // sinon on retourne le résultat
            return $categories;
        }
        $this->bdd = null;
    }

    // récupération d'une catégorie
    public function getCategory($id)
    {
        // requête
        $request = "SELECT * FROM categories WHERE id = :id";
        $select = $this->bdd->prepare($request);
        // execution avec liaison des param
        $select->execute([
            'id' => $id
        ]);
        // récupération des résultats
        $category = $select->fetch(PDO::FETCH_ASSOC);

        if (!$category) {
            return null;
        } else {
            return $category;
        }
        $this->bdd = null;
    }

    // delete d'une catégorie
    public function deleteCategory($id)
    {
        // requête
        $request = "DELETE FROM categories WHERE id = :id";
        $delete = $this->bdd->prepare($request);
        // execution avec liaison des param
        $delete->execute([
            'id' => $id
        ]);

        if (!$delete) {
            return null;
        } else {
            echo "ok";
        }
        // fermeture de la co a la bdd
        $this->bdd = null;
    }

    // ajout d'une catégorie
    public function addCategory($category)
    {
        // requête
        $request = "INSERT INTO categories (categorie) VALUES (:category)";
        $insert = $this->bdd->prepare($request);
        // execution avec liaison des param
        $insert->execute([
            'category' => $category
        ]);

        if (!$insert) {
            return null;
        } else {
            echo "ok";
        }
        // fermeture de la co a la bdd
        $this->bdd = null;
    }

    // update d'une catégorie
    public function updateCategory($id, $category)
    {
        // requête
        $request = "UPDATE categories SET categorie = :category WHERE id = :id";
        $update = $this->bdd->prepare($request);
        // execution avec liaison des param
        $update->execute([
            'category' => $category,
            'id' => $id
        ]);

        if (!$update) {
            return null;
        } else {
            echo "ok";
        }
        // fermeture de la co a la bdd
        $this->bdd = null;
    }

    // verif que l'article existe
    private function articleExist($id_article)
    {
        // requête
        $request = "SELECT * FROM articles WHERE id = :id_article";
        $select = $this->bdd->prepare($request);
        // execution avec liaison des param
        $select->execute([
            'id_article' => $id_article
        ]);
        if ($select->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // like d'un article
    public function like($id_article, $id_utilisateur)
    {
        return $this->vote($id_article, $id_utilisateur, 1);
    }

    // dislike d'un article
    public function dislike($id_article, $id_utilisateur)
    {
        return $this->vote($id_article, $id_utilisateur, -1);
    }

    // réalisation du vote
    private function vote($id_article, $id_utilisateur, $valeur)
    {
        // verif que l'article existe
        if ($this->articleExist($id_article) == false) {
            return "article inexistant";
            // return false;
        }
        // verif que l'utilisateur n'a pas déjà voté
        $request = "SELECT * FROM votes WHERE id_article = :id_article AND id_utilisateur = :id_utilisateur";
        $select = $this->bdd->prepare($request);
        $select->execute([
            'id_article' => $id_article,
            'id_utilisateur' => $id_utilisateur
        ]);
        $vote = $select->fetch(PDO::FETCH_ASSOC);
        if ($vote) {
            if ($vote['valeur'] == $valeur) {
                // delete
                $request = "DELETE FROM votes WHERE id_article = :id_article AND id_utilisateur = :id_utilisateur";
                $delete = $this->bdd->prepare($request);
                $delete->execute([
                    'id_article' => $id_article,
                    'id_utilisateur' => $id_utilisateur
                ]);
                return true;
            }
            // update
            $request = "UPDATE votes SET valeur = :valeur WHERE id_article = :id_article AND id_utilisateur = :id_utilisateur";
            $update = $this->bdd->prepare($request);
            $update->execute([
                'valeur' => $valeur,
                'id_article' => $id_article,
                'id_utilisateur' => $id_utilisateur
            ]);
            return true;
        }
        // requête
        $request = "INSERT INTO votes SET id_article = :id_article, id_utilisateur = :id_utilisateur, valeur = :valeur";
        $insert = $this->bdd->prepare($request);
        // execution avec liaison des param
        $insert->execute([
            'id_article' => $id_article,
            'id_utilisateur' => $id_utilisateur,
            'valeur' => $valeur
        ]);
        // fermeture de la co a la bdd
        $this->bdd = null;
        return true;
    }

    // update des likes et dislikes d'un article
    public function updateLikes($id_article)
    {
        // verif que l'article existe
        if ($this->articleExist($id_article) == false) {
            return false;
        }
        // requête
        $request = "SELECT COUNT(valeur) AS total, valeur FROM votes WHERE id_article = :id_article GROUP BY valeur";
        $select = $this->bdd->prepare($request);
        // execution avec liaison des param
        $select->execute([
            'id_article' => $id_article
        ]);
        // récupération des résultats
        $likes = $select->fetchAll();
        $counts = [
            '1' => 0,
            '-1' => 0
        ];
        foreach ($likes as $like) {
            $counts[$like['valeur']] = $like['total'];
        }

        // requête
        $request = "UPDATE articles SET likes = :likes, dislikes = :dislikes WHERE id = :id_article";
        $update = $this->bdd->prepare($request);
        // execution avec liaison des param
        $update->execute([
            'likes' => $counts['1'],
            'dislikes' => $counts['-1'],
            'id_article' => $id_article
        ]);
        // fermeture de la co a la bdd
        $this->bdd = null;
        return true;
    }

    // check si un utilisateur a déjà voté pour un article
    public function checkVote($id_article, $id_utilisateur)
    {
        // verif que l'article existe
        if ($this->articleExist($id_article) == false) {
            return false;
        }
        // requête
        $request = "SELECT valeur FROM votes WHERE id_article = :id_article AND id_utilisateur = :id_utilisateur";
        $select = $this->bdd->prepare($request);
        // execution avec liaison des param
        $select->execute([
            'id_article' => $id_article,
            'id_utilisateur' => $id_utilisateur
        ]);
        // récupération des résultats
        $vote = $select->fetch(PDO::FETCH_ASSOC);
        if ($vote) {
            return $vote['valeur'];
        } else {
            return 0;
        }
    }
}
