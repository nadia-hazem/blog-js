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
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/profil.js"></script>

</head>

<body>

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <div class="container">

                <h1>Profil</h1>
                <p>Bonjour <span id="msg"><?= $login ?></span></p>
                <section id="login">
                    <div class="background_form">
                        <h2>Modifier le login</h2>
                        <form action="" method="post" id="loginForm">
                            <label for="login">login</label>
                            <input type="text" name="login" class="login" value="<?= $login ?>" required>
                            <p></p>
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="password" placeholder="Mot de passe" required>
                            <p></p>
                            <input type="submit" value="Modifier" name="send" id="btnModifLogin">
                            <p></p>
                        </form>
                    </div>
                </section>
                <section id="password">
                    <div class="background_form">
                        <h2>Modifier le mot de passe</h2>
                        <form action="" method="post" id="passwordForm">
                            <label for="password">Ancien mot de passe</label>
                            <input type="password" name="password" class="password" placeholder="Mot de passe" id="oldPassword" required>
                            <p></p>
                            <label for="newPassword">Nouveau mot de passe</label>
                            <input type="password" name="newPassword" id="newPassword" placeholder="nouveau mot de passe" required>
                            <p></p>
                            <label for="newPassword2">Confirmation du nouveau mot de passe</label>
                            <input type="password" name="newPassword2" id="newPassword2" placeholder="Confirmation du nouveau mot de passe" required>
                            <p></p>
                            <input type="submit" value="Modifier" name="send" id="btnModifPass">
                            <p></p>
                        </form>
                    </div>
                </section>


            </div> <!-- /container -->

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>

</html>