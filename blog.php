<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$articles = $article->getAllArticles();
$categories = $article->getCategories();
$description = $article->getDescription();
$summary = $article->createSummary($description);
$articlesPerPage = 6;
if (isset($_SESSION['categInt'])) {
    $categInt = $_SESSION['categInt'];
} else {
    $categInt = 0;
}
if (isset($_GET['categInt'])) {
    $categInt = $_GET['categInt'];
    $_SESSION['categInt'] = $categInt;
}

?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@400&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/blog.js"></script>
</head>

<body id="blog">

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <section class="blog">

                <h1 class="title" data-aos="fade-in">Trippy Blog</h1>

            </section>

            <div class="container mt-0">

                <?php
                if ($user->isUserMode()) {
                ?>
                    <a href="createArticle.php" class="text-white text-center"><button class="post">Créer un article</button></a>
                <?php
                }
                ?>

                <div id="divCateg" class="text-center radius">
                    <label for="category" class="p-1">
                        <h2>Catégorie</h2>
                    </label>
                    <select name="categorie" id="selectCategory"></select>
                </div>

                <section class="articles my-3">

                    <?php
                    // Récupérer le nombre total d'articles
                    if ($categInt == 0) {
                        $total_articles = count($article->getAllArticles());
                    } else {
                        $total_articles = count($article->countArticlesByCategory($categInt));
                    }
                    // Définir le nombre d'articles à afficher par page
                    $num_articles = 6;
                    // Calculer le nombre total de pages
                    $total_pages = ceil($total_articles / $num_articles);
                    // Récupérer le numéro de la page courante
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    // Calculer l'indice de départ pour la requête LIMIT
                    $start_index = ($current_page - 1) * $num_articles;
                    // Récupérer les articles pour la page courante en utilisant LIMIT
                    $articles = $article->getArticlesPerPage($start_index, $num_articles, $categInt);
                    // Afficher les articles récupérés
                    foreach ($articles as $article) :
                    ?>
                        <!-- CARD -->
                        <div class="card">
                            <img class="uploadedImg" src="assets/uploads/<?php echo $article['image']; ?>" alt="<?php echo $article['titre']; ?>">


                            <div class="card-content">
                                <h2><?php echo $article['titre']; ?></h2>
                                <p><small><i>Publié le </i><span class="text-turquoise"><?php echo $article['date']; ?></span> par <b><?php echo $article['auteur']; ?></b></small></p>
                                <p><i>Catégorie : </i><span class="text-turquoise"><?php echo $article['categ']; ?></span></i></p>
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
                    echo '<a href="?page=' . ($current_page - 1) . ' ">&nbsp; Page précédente &nbsp;</a>';
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo '<span class="current_page active">' . $i . '</span>';
                    } else {
                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                    }

                    // Ajouter un tiret entre les numéros de pages
                    if ($i < $total_pages) {
                        echo ' - ';
                    }
                }
                if ($current_page < $total_pages) {
                    echo '<a href="?page=' . ($current_page + 1) . ' ">&nbsp; Page suivante &nbsp;</a>';
                }
                echo '</div>';
                ?>

            </div> <!-- /container -->

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