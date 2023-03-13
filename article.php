<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
require_once 'assets/class/Comments.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$comment = new Comments($db);
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
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
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
    $categories = $item['categ'];
    $description = $item['description'];
    $image = $item['image'];
    ?>

    <div class="wrapper">

        <main>

            <?php if (!empty($item['image'])) : ?>
                <img class="banner" src="assets/uploads/<?= $item['image'] ?>" alt="<?= $titre ?>">
            <?php endif; ?>

            <div class="container">

                <div class="article">

                    <h1><?= $titre ?></h1>

                    <small class="article-meta">Publié le <?= $date ?> par : <?= $auteur ?> | <span class="cat">catégorie : <?= $categories ?></span></small>

                    <p class="article-description"><?= $description ?></p>

                </div> <!-- /content -->

            </div> <!-- /container -->

            <h2>Commentaires</h2>
            <section class="comments bg-light border radius p-2">

                <?php
                $comments = $comment->getComments($id);
                if (is_array($comment->getComments($id))) {
                    $id = $comment['id'];
                    $auteur = $comment['auteur'];
                    $date = $comment['date'];
                    $commentaire = $comment['commentaire'];

                    echo '<div class="comment">';
                    echo '<h3>' . $auteur . '</h3>';
                    echo '<small class="comment-meta">Publié le ' . $date . '</small>';
                    echo '<p>' . $commentaire . '</p>';
                    echo '</div>';
                }
                ?>

            </section>

            <h2>Laissez un commentaire</h2>
            <section class="container">

                <form action="verification.php" method="post" class="m-auto">

                    <textarea name="commentaire" cols="40" rows="10" placeholder="Votre commentaire :"></textarea>
                    <input type="submit" class="" name="go" value="Signer">

                </form>

            </section>

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>

</html>