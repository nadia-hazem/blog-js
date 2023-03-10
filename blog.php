<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$articles = $article->getAllArticles();
$description = $article->getDescription();
$summary = $article->createSummary($description);
?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
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

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <div class="container">

                <h1>Blog</h1>

                <?php
                if ($user->isUserMode()) {
                    ?>
                    <button class="post"><a href="createArticle.php">Créer un article</a></button>
                    <?php
                }
                ?>

                <section class="articles">

                    <?php 
                    // Récupérer le nombre total d'articles
                    $total_articles = count($article->getAllArticles());
                    // Calculer le nombre total de pages
                    $total_pages = ceil($total_articles / 5);
                    // Récupérer le numéro de la page courante
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    // Calculer l'indice de départ pour la requête LIMIT
                    $start_index = ($current_page - 1) * 5;
                    // Récupérer les articles pour la page courante en utilisant LIMIT
                    $articles = $article->getAllArticles($start_index, 5);
                    // Afficher les articles récupérés
                    foreach ($articles as $article) : 
                        ?>
                        <!-- CARD -->
                        <div class="card">
                            <img class="uploadedImg" src="assets/uploads/<?php echo $article['image']; ?>" alt="<?php echo $article['titre']; ?>">
                            
                            <div class="card-content">
                                <h2><?php echo $article['titre']; ?></h2>
                                <p><small>Publié le <?php echo $article['date']; ?> par <?php echo $article['auteur']; ?></small></p>
                                <br>

                                <p><?php echo $article['summary']; ?></p>
                                <a href="article.php?id=<?php echo $article['id']; ?>">Lire la suite</a>

                            </div> <!-- /card-content -->
                        </div> <!-- /card -->

                        <?php 
                    endforeach; 
                    ?>
                </section>
                <?php
                    // affichage des liens de pagination
                    echo '<div id="pagination">';
                        if ($current_page > 1) {
                            echo '<a href="?page=' . ($current_page - 1) . '">&nbsp; Page précédente &nbsp;</a>';
                        }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo '<span class="current_page">' . $i . '</span>';
                        } else {
                            echo '<a href="?page=' . $i . '">' . $i . '</a>';
                        }
                    }

                    if ($current_page < $total_pages) {
                        echo '<a href="?page=' . ($current_page + 1) . '">&nbsp; Page suivante &nbsp;</a>';
                    }
                    echo '</div>';
                    ?>

                <section id="comments">
                    <!--Commentaires ici-->
                </section>

            </div> <!-- /container -->

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>
</html>