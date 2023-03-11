<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$articles = $article->getArticlesPerPage(0, 5);
$description = $article->getDescription();
$summary = $article->createSummary($description);
$articlesPerPage = 5;
?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- ism -->
    <link rel="stylesheet" href="ism/css/my-slider.css"/>
    <script src="ism/js/ism-2.2.min.js"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>

</head>

<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="wrapper">
        <main>
            <!-- SLIDER -->
            <div class="ism-slider" data-transition_type="fade" data-play_type="loop" id="my-slider">
                <ol>
                    <li>
                        <?php 
                        $articles = $article->getArticlesPerPage(0, 1); // Récupération des 3 derniers articles 
                        foreach ($articles as $article) { ?>
                            <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                            <div class="ism-caption ism-caption-0">
                                <h2><?= $article['titre'] ?></h2>
                                <?php echo '<a href="article.php?id=' . $article['id'] . '">Lire la suite</a>';?>
                            </div>
                            <?php
                        } ?>

                    </li>
                    <li>
                        <?php
                        $articles = $article->getArticlesPerPage(0, 2); // Récupération des 3 derniers articles 
                            foreach ($articles as $article) { ?>
                                <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                                <div class="ism-caption ism-caption-0">
                                    <h2><?= $article['titre'] ?></h2>
                                    <?php echo '<a href="article.php?id=' . $article['id'] . '">Lire la suite</a>';?>
                                </div>
                                <?php
                            } ?>
                    </li>
                    <li>
                    <?php
                        $articles = $article->getArticlesPerPage(2); // Récupération des 3 derniers articles 
                            foreach ($articles as $article) { ?>
                                <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                                <div class="ism-caption ism-caption-0">
                                    <h2><?= $article['titre'] ?></h2>
                                    <?php echo '<a href="article.php?id=' . $article['id'] . '">Lire la suite</a>';?>
                                </div>
                                <?php
                            } ?>
                    </li>
                    <li>
                    <?php
                        $articles = $article->getArticlesPerPage(3); // Récupération des 3 derniers articles 
                            foreach ($articles as $article) { ?>
                                <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                                <div class="ism-caption ism-caption-0">
                                    <h2><?= $article['titre'] ?></h2>
                                    <?php echo '<a href="article.php?id=' . $article['id'] . '">Lire la suite</a>';?>
                                </div>
                                <?php
                            } ?>
                    </li>
                </ol>
            </div>


            <section class="">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                        <h3>Si vous êtes passionné(e) de voyage et que vous cherchez des idées d'itinéraires, des astuces pour économiser de l'argent et des conseils pour découvrir des endroits incroyables dans le monde entier, vous êtes au bon endroit !</h3>

                        <p>Sur ce blog, nous partageons nos aventures de voyage et nos expériences, ainsi que nos coups de cœur et nos déceptions. Que vous soyez à la recherche d'inspiration pour votre prochaine destination ou que vous souhaitiez simplement en savoir plus sur les voyages, vous trouverez ici une mine d'informations pour vous aider à planifier votre prochaine aventure.</p>

                        <p>En parcourant notre blog, vous découvrirez des récits de voyages passionnants, des astuces pour voyager à petit budget, des guides et des conseils pour la sécurité en voyage et bien plus encore.</p>

                        </div>
                    </div>
                </div>
            </section>

            <section class="blog-slider">
                <h1 class="title">Derniers articles</h1>
                <?php 
                $articles = $article->getArticlesPerPage(0, 4); // Récupération des 4 derniers articles 
                foreach ($articles as $article) { ?>
                    <div class="thumb">
                        <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                        <div class="thumb-content">
                            <h2><?= $article['titre'] ?></h2>
                            <p><?= $article['summary'] ?></p>
                            <?php echo '<a href="article.php?id=' . $article['id'] . '">Lire la suite</a>';?>
                        </div>
                    </div>
                    <?php
                } ?>
            </section>
            
            <!-- HERO -->

            <div class="container">
                

                
                
                
                
                </div> <!-- /container -->
                
            </main>

            <div class="push"></div>
            
        </div> <!-- /wrapper -->

        <?php include 'includes/footer.php'; ?>

        <!-- >Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>
    </html>