<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
$db = new DbConnect();
$user = new User($db);
?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaires</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/blog-js/assets/img/favicon.png"/>   
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/forms.js"></script>

</head>

<body id="forms">
    <?php include 'includes/header.php' ?>

    <div class="wrapper">

        <main class="mainforms">

            <div class="container mt-0">

                <section id="inscription" class="colcenter">

                    <h1>Inscription</h1>

                    <div class="row m-2">
                        <p><b>Vous avez déjà un compte ? </b></p> <button id="switchConn" class="switch">Connexion</button>
                    </div>

                    <form method="post" class="auth_form">
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" placeholder="login" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" autocomplete="off" required>
                        <p></p>
                        <label for="password2">Confirmation du mot de passe</label>
                        <input type="password" name="password2" id="password2" class="password" placeholder="Confirmation" autocomplete="off" required>
                        <p></p>
                        <br>
                        <input type="submit" value="S'inscrire" name="send" id="btnInsc">
                        <p></p>
                    </form>
                    <br>
                </section>

                <!--------------------------------------------------------------------->

                <section id="connexion" class="colcenter">

                    <h1>Connexion</h1>

                    <div class="row m-2">
                        <p><b>Vous n'avez pas encore de compte ? </b></p> <button id="switchInsc" class="switch">Inscription</button>
                    </div>

                    <form method="post" class="auth_form">
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" placeholder="login" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" required>
                        <p></p>
                        <input type="submit" value="Se connecter" id="btnConn">
                        <p></p>
                    </form>
                    <br>
                </section>

            </div>

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

    <!-- Animations AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>