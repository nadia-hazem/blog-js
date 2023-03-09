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
    public function createArticle($article)
    {
        // html special char
        $article = htmlspecialchars($article);

        // requete
        $request = "INSERT INTO articles (titre, date, description, image) VALUES (:titre, NOW(), :description, :image)";

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
    
    function getTitre($id)
    {
        // html special char
        $id = htmlspecialchars($id);

        // requete
        $request = "SELECT titre FROM articles WHERE id = :id";
        
        $select = $this->bdd->prepare($request);
        
        // execution avec liaison des params
        $select->execute([
            'id' => $id
        ]);
        
        // récupération des résultats
        $titre = $select->fetchColumn();
        
        // fermeture de la co a la bdd
        $this->bdd = null;
        
        return $titre;
    }

    function getArticleDate($id) {

        $request = "SELECT date FROM articles WHERE id = :id";
        $select = $this->bdd->prepare($request);
        $select->execute(['id' => $id]);
        $date = $select->fetchColumn();

        if ($date) {
            $dateTime = new DateTime($date);
            return $dateTime->format('d/m/Y à H:i:s');
        } else {
            return null;
        }
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
    
        // fermeture de la co a la bdd
        $this->bdd = null;
    
        return $article;
    }
    
    function getAuteur($article)
    {
        return $article['auteur'];
    }
    
    

}
?>