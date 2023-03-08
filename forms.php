<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
$db = new DbConnect();
$user = new User($db);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/forms.js"></script>
    
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="wrapper">
        <main>

            <div class="container">

                <section id="inscription">

                    <h1>Inscription</h1>
                    
                    <form action="" method="post">
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" placeholder="login" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" autocomplete="off" required>
                        <p></p>
                        <label for="password2">Confirmation du mot de passe</label>
                        <input type="password" name="password2" id="password2" placeholder="Confirmation du mot de passe" autocomplete="off" required>
                        <p></p>
                        <input type="submit" value="S'inscrire" name="send" id="btnInsc">
                        <p></p>
                    </form>

                    <button id="switchConn">Connexion</button>

                </section>
                
                <!--------------------------------------------------------------------->

                <section id="connexion">

                    <button id="switchInsc">Inscription</button>

                    <h1>Connexion</h1>
                    <form action="" method="post">
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" placeholder="login" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" required>
                        <p></p>
                        <input type="submit" value="Se connecter" id="btnConn">
                        <p></p>
                    </form>

                </section>
            </div>

        </main>

        <div class="push"></div>
    
    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>
</body>
</html>