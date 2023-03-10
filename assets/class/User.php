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
            $_SESSION['user'] = [
                'id' => $result['id'],
                'login' => $result['login'],
                'password' => $result['password']
            ];
            echo "Connexion réussie !";
        } else {
            echo "mot de passe incorrect !";
        }
        $this->bdd = null;
    }

    // Vérifier si l'utilisateur est connecté
    public function isConnected()
    {
        if ($this->id != null && $this->login != null && $this->password != null) {
            return true;
        } else {
            return false;
        }
    }

    // Déconnexion
    public function disconnect()
    {
        if ($this->isConnected()) {
            $this->id = null;
            $this->login = null;
            $this->password = null;

            // fermeture de la connexion
            session_unset();
            session_destroy();
        } else {
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

    // Modification login
    public function updateLogin($login, $old, $password)
    {
        // requête
        $requete = "SELECT * FROM utilisateurs where login = :old";

        // préparation de la requête
        $select = $this->bdd->prepare($requete);

        // htmlspecialchars pour les paramètres
        $old = htmlspecialchars($old);
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        // récupération du mot de passe avec ASSOC
        $select->execute(array(':old' => $old));
        $fetch_assoc = $select->fetch(PDO::FETCH_ASSOC);
        $password_hash = $fetch_assoc['password'];

        if (password_verify($password, $password_hash)) {
            // requête pour modifier le login dans la base de données
            $requete2 = "UPDATE utilisateurs SET login=:login WHERE id=:id";
            // préparation de la requête
            $update = $this->bdd->prepare($requete2);
            // exécution de la requête avec liaison des paramètres
            $update->execute(array(
                ':login' => $login,
                ':id' => $this->id,
            ));
            // récupération des données pour les attribuer aux attributs
            $this->id = $fetch_assoc['id'];
            $this->login = $login;
            $this->password = $fetch_assoc['password'];

            $_SESSION['user'] = [
                'id' => $fetch_assoc['id'],
                'login' => $login,
                'password' => $fetch_assoc['password'],
            ];
            // update réussie
            $error = "ok";
            echo $error;
        } else {
            $error = "incorrect";
            echo $error; // mot de passe incorrect
        }

        // fermer la connexion
        $this->bdd = null;
    }

    // Modification mot de passe
    public function updatePassword($password, $newPassword)
    {
        // requête
        $requete = "SELECT * FROM utilisateurs where login = :login";

        // préparation de la requête
        $select = $this->bdd->prepare($requete);

        // htmlspecialchars pour les paramètres
        $login = htmlspecialchars($this->login);
        $password = htmlspecialchars($password);
        $newPassword = htmlspecialchars($newPassword);

        // récupération du mot de passe avec ASSOC
        $select->execute(array(':login' => $login));
        $fetch_assoc = $select->fetch(PDO::FETCH_ASSOC);
        $password_hash = $fetch_assoc['password'];

        if (password_verify(
            $password,
            $password_hash
        )) {
            // requête pour modifier le mdp dans la base de données
            $requete2 = "UPDATE utilisateurs SET password=:password WHERE id=:id";
            // préparation de la requête
            $update = $this->bdd->prepare($requete2);
            // hash du nouveau mdp
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            // exécution de la requête avec liaison des paramètres
            $update->execute(array(
                ':password' => $newPassword,
                ':id' => $this->id,
            ));
            // récupération des données pour les attribuer aux attributs
            $this->id = $fetch_assoc['id'];
            $this->login = $login;
            $this->password = $newPassword;

            $_SESSION['user'] = [
                'id' => $fetch_assoc['id'],
                'login' => $login,
                'password' => $newPassword,
            ];
            // update réussie
            $error = "ok";
            echo $error;
        } else {
            $error = "incorrect";
            echo $error; // mot de passe incorrect
        }

        // fermer la connexion
        $this->bdd = null;
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

    // Supprimer son compte
    public function delete()
    {
        if ($this->isConnected()) {   // requête de suppression
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
            } else {
                echo "Erreur lors de la suppression de l'utilisateur !";
            }
        } else {
            echo "Vous devez être connecté pour supprimer votre compte !";
        }
        // fermeture de la connexion
        $this->bdd = null;
    }

    // vérifier que l'utilisateur connecté est admin ou modérateur
    public function isUserMode()
    {
        if ($this->isConnected()) {
            $request = "SELECT * FROM utilisateurs WHERE id = :id";
            // préparation de la requête
            $select = $this->bdd->prepare($request);
            // exécution de la requête avec liaison des paramètres
            $select->execute(array(
                ':id' => $this->id,
            ));
            // récupération des résultats
            $result = $select->fetch(PDO::FETCH_ASSOC);
            // vérification des droits
            if ($result['droit'] == 'admin' || $result['droit'] == 'mode') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // vérifier que l'utilisateur connecté est admin
    public function isUserAdmin()
    {
        if ($this->isConnected()) {
            $request = "SELECT * FROM utilisateurs WHERE id = :id";
            // préparation de la requête
            $select = $this->bdd->prepare($request);
            // exécution de la requête avec liaison des paramètres
            $select->execute(array(
                ':id' => $this->id,
            ));
            // récupération des résultats
            $result = $select->fetch(PDO::FETCH_ASSOC);
            // vérification des droits
            if ($result['droit'] == 'admin') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // récupérer les utilisateurs
    public function getUsers()
    {
        $request = "SELECT * FROM utilisateurs";
        // préparation de la requête
        $select = $this->bdd->prepare($request);
        // exécution de la requête
        $select->execute();
        // récupération des résultats
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // supprimer un utilisateur (via panel admin)
    public function deleteUser($id)
    {
        // htmlspecialchar
        $id = trim(htmlspecialchars($id));
        // requête
        $delete = "DELETE FROM utilisateurs WHERE id = :id ";
        // préparation de la requête
        $delete = $this->bdd->prepare($delete);
        // exécution de la requête avec liaison des paramètres
        $delete->execute(array(
            ':id' => $id
        ));
        // vérification que la requête a fonctionné
        if ($delete == TRUE) {
            echo "ok";
        } else {
            echo "Erreur lors de la suppression de l'utilisateur !";
        }
        // fermeture de la connexion
        $this->bdd = null;
    }

    // modifier les droits d'un utilisateurs (via panel admin)
    public function changeDroit($id, $droit)
    {
        // htmlspecialchar
        $id = trim(htmlspecialchars($id));
        $droit = trim(htmlspecialchars($droit));
        // requête
        $update = "UPDATE utilisateurs SET droit=:droit WHERE id = :id";
        // préparation de la requête
        $update = $this->bdd->prepare($update);
        // exécution de la requête avec liaison des paramètres
        $update->execute(array(
            ':id' => $id,
            ':droit' => $droit
        ));
        // vérification que la requête a fonctionné
        if ($update == TRUE) {
            echo "ok";
        } else {
            echo "Erreur lors de la modification des droits de l'utilisateur !";
        }
        // fermeture de la connexion
        $this->bdd = null;
    }
}
