<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$id = $_GET['id']; 
?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>

</head>
<body>

    <?php include 'includes/header.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: blog.php');
    }
    $item = $article->getArticle($id);
    $titre = $item['titre'];
    $date = $item['date'];
    $auteur = $item['auteur'];
    $continent = $item['continent'];
    $description = $item['description'];

    ?>

    <div class="wrapper">

        <main>

            <div class="container">

                <h1>Article</h1>

                <div class="article">

                    <h2><?= $titre ?></h2>

                    <small class="article-meta"></small>

                    <p class="article-description"><?= $article->getArticle($db) ?></p>

                </div> <!-- /content -->

            </div> <!-- /container -->

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>
</html>