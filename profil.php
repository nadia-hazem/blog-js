<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
$db = new DbConnect();
$user = new User($db);
if (!$user->isConnected()) {
    header('Location: user.php?choice=login');
}
$login = $user->getLogin();
?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/blog-js/assets/img/favicon.png"/>   
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/profil.js"></script>

</head>

<body id="profil">

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <h1 class="title" data-aos="fade-in">Profil</h1>

            <div class="row wrap">

                <div id="login" class="profilForm col">

                    <form action="" method="post" id="loginForm" class="col" data-aos="fade-right">
                        <h2 class="mb-1">Modifier le login</h2>
                        <label for="login">login</label>
                        <input type="text" name="login" class="login" value="<?= $login ?>" required>
                        <p></p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" required>
                        <p></p>
                        <input type="submit" value="Modifier" name="send" id="btnModifLogin">
                        <p></p>
                    </form>

                    <form action="" method="post" id="passwordForm" class="col gap my-2" data-aos="fade-left">
                        <h2 class="mb-1">Modifier le mot de passe</h2>
                        <label for="password">Ancien mot de passe</label>
                        <input type="password" name="password" class="password" placeholder="Mot de passe" id="oldPassword" required>
                        <p></p>
                        <div class="row wrap">
                            <div class="col gap">
                                <label for="newPassword">Nouveau</label>
                                <input type="password" name="newPassword" id="newPassword" class="password" placeholder="nouveau mot de passe" required>
                                <p></p>
                            </div>
                            <div class="col gap">
                                <label for="newPassword2">Confirmation</label>
                                <input type="password" name="newPassword2" id="newPassword2" class="password" placeholder="Confirmez mot de passe" required>
                                <p></p>
                            </div>
                        </div>
                        <input type="submit" value="Modifier" name="send" id="btnModifPass">
                        <p></p>
                    </form>
                </div> <!-- /col -->
            </div> <!-- /row -->
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