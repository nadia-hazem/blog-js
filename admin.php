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
    <script src="assets/js/admin.js"></script>

</head>

<body id="admin">

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <div class="container">

                <section id="selection">

                    <h1 class="m-0">Administration</h1>

                    <div class="admin row">

                        <a id="users" href="" class="col text-center p-1">
                            <h3>Gestion des utilisateurs </h3><i class="fas fa-users"></i>
                        </a>

                        <a id="articles" href="" class="col text-center p-1">
                            <h3>Gestion des articles</h3><i class="fas fa-file"></i>
                        </a>

                        <a id="categories" href="" class="col text-center p-1">
                            <h3>Gestion des catégories</h3><i class="fas fa-tags"></i>
                        </a>

                    </div> <!-- /admin row-->

                </section> <!-- /selection -->

                <section id="gestion" class="mb-2 p-1"> </section>

                <section id="article" class="mb-2 p-1"> </section>

                <section id="commentaires" class="mb-2 p-1"> </section>

            </div> <!-- /container -->

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>
</body>

</html>