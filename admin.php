<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
$db = new DbConnect();
$user = new User($db);

// vérification if user is admin
if (!$user->isUserAdmin()) {
    header('Location: index.php');
}
?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
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
    <script src="assets/js/admin.js"></script>

</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <div class="container">


                <section id="selection">

                    <h1>Administration</h1>

                    <div class="admin">
                        <a id="users" href="">Gestion des utilisateurs</a>
                        <a id="articles" href="">Gestion des articles</a>
                    </div>
                </section>

                <section id="gestion">

                </section>

                <section id="article"></section>

                <section id="commentaires"></section>
            </div>

    </div> <!-- /container -->
    </main>

    <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>
</body>

</html>