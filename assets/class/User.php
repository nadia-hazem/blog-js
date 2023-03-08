<?php
require_once 'DbConnect.php';

class User
{
    private $id;
    public $login;
    private $password;
    private $bdd;

    public function __construct(DbConnect $db)
    {
        $this->bdd = $db->getBdd();

        if (isset($_SESSION['user'])) {
            $this->id = $_SESSION['user']['id'];
            $this->login = $_SESSION['user']['login'];
            $this->password = $_SESSION['user']['password'];
        }
    }

        // Enregistrer un nouvel utilisateur
        public function register($login, $password)
        {   
            // special characters
            $login = htmlspecialchars($login);
            $password = htmlspecialchars($password);
            // hash password
            $password = password_hash($password, PASSWORD_DEFAULT);
                    
            $register = "INSERT INTO utilisateurs (login, password) VALUES
            (:login, :password)";
            // préparation de la requête             
            $insert = $this->bdd->prepare($register);
            // exécution de la requête avec liaison des paramètres
            $insert->execute(array(
                ':login' => $login,
                ':password' => $password,
            ));
            echo "Inscription réussie !";
            $this->bdd = null;
        }

            // Connexion
    public function connect($login, $password) 
    {
        // Récupérer le login
        $request = "SELECT * FROM utilisateurs WHERE login = :login";
        // préparation de la requête
        $select = $this->bdd->prepare($request);

        // special characters
        $login = trim(htmlspecialchars($login));
        $password = trim(htmlspecialchars($password));

        // exécution de la requête avec liaison des paramètres
        $select->execute(array(
            ':login' => $login,
        ));
        // récupération des résultats
        $result = $select->fetch(PDO::FETCH_ASSOC);
        // verification password 
        if (password_verify($password, $result['password'])) {
            $_SESSION['user']= [
                'id' => $result['id'],
                'login' => $result['login'],
                'password' => $result['password']
            ]; 
            echo "Connexion réussie !";     
        }
        else {
            echo "mot de passe incorrect !";
        }
        $this->bdd = null;
    }

    // Vérifier si l'utilisateur est connecté
    public function isConnected()
    {
        if($this->id != null && $this->login != null && $this->password != null) {
            return true;
        }
        else {
            return false;
        }
    }

    // Déconnexion
    public function disconnect()
    {  
        if($this->isConnected()) 
            {
                $this->id = null;
                $this->login = null;
                $this->password = null;

            // fermeture de la connexion
            session_unset();
            session_destroy();
            }
            else {
                echo "Vous n'êtes pas connecté(e) !";
            }
    }

    // Utilisateur déjà existant?
    public function isUserExist($login)
    {
        // requête pour vérifier que le login choisi n'est pas déjà utilisé
        $requete = "SELECT * FROM utilisateurs where login = :login";
        // préparation de la requête
        $select = $this->bdd->prepare($requete);
        // htmlspecialchars pour les paramètres
        $login = htmlspecialchars($login);
        // exécution de la requête avec liaison des paramètres
        $select->execute(array(':login' => $login));
        // récupération du tableau
        $fetch_all = $select->fetchAll();
        if (count($fetch_all) === 0) { // login disponible
            $reponse = "dispo";
            echo $reponse; // login disponible
        } else {
            $reponse = "indispo";
            echo $reponse; // login indisponible
        }
        $this->bdd = null;
    }

    // Changer le login
    public function changeLogin($login, $password)
    {
        $request = "SELECT * FROM utilisateurs WHERE login = :login";
        // préparation de la requête
        $select = $this->bdd->prepare($request);

        // special characters
        $login = trim(htmlspecialchars($login));
        $password = trim(htmlspecialchars($password));

        // exécution de la requête avec liaison des paramètres
        $select->execute(array(
            ':login' => $this->login,
        ));
        // récupération des résultats
        $result = $select->fetch(PDO::FETCH_ASSOC);
        // verif password
        if (password_verify($password, $result['password'])) {
            $update = "UPDATE utilisateurs SET login=:login WHERE id = :id";
            // préparation de la requête
            $update = $this->bdd->prepare($update);
            // exécution de la requête avec liaison des paramètres
            $update->execute(array(
                ':login' => $login,
                ':id' => $result['id']
                // ':login' => $this->['id']
            ));

            $_SESSION['user']= [
                'id' => $result['id'],
                'login' => $login,
                'password' => $result['password']
            ]; 
            echo "Login changé !";     
        }
        else {
            echo "mot de passe incorrect !";
        }
        $this->bdd = null;
    }
    
    // Changer le mot de passe
    public function changePassword($oldPassword, $newPassword)
    {
        $request = "SELECT * FROM utilisateurs WHERE id = :id";
        // préparation de la requête
        $select = $this->bdd->prepare($request);
        
        // special characters
        $newPassword = trim(htmlspecialchars($newPassword));
        $id = trim(htmlspecialchars($this->id));
        
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $select->execute(array(
            ':id' => $this->id,
        ));
        // récupération des résultats
        $result = $select->fetch(PDO::FETCH_ASSOC);
        // verif password
        if (password_verify($oldPassword, $result['password'])) {
            $update = "UPDATE utilisateurs SET password=:password WHERE id = :id";
            // préparation de la requête
            $update = $this->bdd->prepare($update);
            // exécution de la requête avec liaison des paramètres
            $update->execute(array(
                ':id' => $id,
                ':password' => $newPassword
            ));
            echo 'Mot de passe changé !';
        }
        else {
            echo "mot de passe incorrect !";
        }
    }   

    // Récupérer Id
    public function getId()
    {
        return $this->id;
    }

    // Récupérer Login
    public function getLogin()
    {
        return $this->login;
    }

    // Supprimer le compte
    public function delete()
    {   
        if($this->isConnected()) 
        {   // requête de suppression
            $delete = "DELETE FROM utilisateurs WHERE id = :id ";
            // préparation de la requête
            $delete = $this->bdd->prepare($delete);
            // exécution de la requête avec liaison des paramètres
            $delete->execute(array(
                ':id' => $this->id
            ));
            // récupération des résultats
            $result = $delete->fetchAll();
            // vérification de la suppression
            if ($result == TRUE) {
                echo "Utilisateur supprimé !"; 
                session_destroy();
            }
            else{
                echo "Erreur lors de la suppression de l'utilisateur !";
            }
        }
        else {
            echo "Vous devez être connecté pour supprimer votre compte !";
        }
        // fermeture de la connexion
        $this->bdd = null; 
    }   
    
}
?>