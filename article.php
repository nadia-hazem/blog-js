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
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
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
    $image = $item['image'];
    ?>

    <div class="wrapper">

        <main>

            <?php if (!empty($item['image'])): ?>
                <img class="banner" src="assets/uploads/<?= $item['image'] ?>" alt="<?= $titre ?>">
            <?php endif; ?>

            <div class="container">

                <div class="article">

                    <h1><?= $titre ?></h1>

                    <small class="article-meta">Publié le <?= $date ?> par : <?= $auteur ?> | <span class="cat">catégorie : <?= $continent ?></span></small>

                    <p class="article-description"><?= $description ?></p>

                </div> <!-- /content -->

            </div> <!-- /container -->

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>
</html>