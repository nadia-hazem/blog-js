<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$articles = $article->getArticlesPerPage(0, 5);
$articlesPerPage = 4;
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
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- ism -->
    <link rel="stylesheet" href="ism/css/my-slider.css" />
    <script src="ism/js/ism-2.2.min.js"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>

</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="wrapper">
        <main>

            <!-- SLIDER -->
            <div class="ism-slider" data-play_type="loop" id="my-slider">
                <ol>
                    <?php
                    $articles = $article->getArticlesPerPage(0, 4);
                    foreach ($articles as $key => $article) { ?>
                        <li>
                            <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                            <div class="ism-caption ism-caption-0">
                                <h1><?= $article['titre'] ?></h1>
                                <p><?= $article['date'] ?></p>
                                <a href="article.php?id=<?= $article['id'] ?>">Lire la suite</a>
                            </div>
                        </li>
                    <?php } ?>
                </ol>
            </div>


            <section class="">
                <div class="container">
                    <h1 class="franklin">Trippy Le blog de voyage</h1>
                    <div class="row">
                        <div class="col-33 float-right">
                            <img src="assets/img/stamp.png" width="80%" alt="Tampons de douane">
                        </div>
                        <div class="col-60 mt-4">
                            <h3>Si vous êtes passionné(e) de voyage et que vous cherchez des idées d'itinéraires, des astuces pour économiser de l'argent et des conseils pour découvrir des endroits incroyables dans le monde entier, vous êtes au bon endroit !</h3>

                            <p>Sur ce blog, nous partageons nos aventures de voyage et nos expériences, ainsi que nos coups de cœur et nos déceptions. Que vous soyez à la recherche d'inspiration pour votre prochaine destination ou que vous souhaitiez simplement en savoir plus sur les voyages, vous trouverez ici une mine d'informations pour vous aider à planifier votre prochaine aventure.</p>

                            <p>En parcourant notre blog, vous découvrirez des récits de voyages passionnants, des astuces pour voyager à petit budget, des guides et des conseils pour la sécurité en voyage et bien plus encore.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container my-5">
                    <h2 class="double">Conseils de voyage</h2>

                    <div class="row ">
                        <div class="col card mx-2">
                            <a href="#"><img src="assets/img/conseils.png" alt="guide">
                                <div class="card-content">
                                    <h3 class="text-center my-1">Guide voyage</h3>

                                </div>
                            </a>
                        </div> <!-- /col -->

                        <div class="col card mx-2">
                            <a href="#"><img src="assets/img/inspiration.png" alt="inspiration">
                                <div class="card-content">
                                    <h3 class="text-center my-1">Inspirations</h3>

                                </div>
                            </a>
                        </div> <!-- /col -->

                        <div class="col card mx-2">
                            <a href="#"><img src="assets/img/bonsplans.png" alt="bons plans">
                                <div class="card-content">
                                    <h3 class="text-center my-1">Bons plans</h3>

                                </div>
                            </a>
                        </div> <!-- /col -->

                    </div> <!-- /row -->
                </div> <!-- /container -->
            </section>

            <section class="bg-sable h-50 py5">
                <h2>Destinations</h2>

                <div class="row m-2 py-5">
                    <a href="#">
                        <div class="col continent px-3">
                            <img src="assets/img/afrique.png" width="130px" alt="Afrique">
                            <h3>Afrique</h3>
                        </div>
                    </a>
                    <a href="#">
                        <div class="col continent px-3">
                            <img src="assets/img/ameriquenord.png" width="130px" alt="Amérique du Nord">
                            <h3>Amérique/Nord</h3>
                        </div>
                    </a>
                    <a href="#">
                        <div class="col continent px-3">
                            <img src="assets/img/ameriquesud.png" width="130px" alt="Amérique du Sud">
                            <h3>Amérique/Sud</h3>
                        </div>
                    </a>
                    <a href="#">
                        <div class="col continent px-3">
                            <img src="assets/img/asie.png" width="130px" alt="Asie">
                            <h3>Asie</h3>
                        </div>
                    </a>
                    <a href="#">
                        <div class="col continent px-3">
                            <img src="assets/img/europe.png" width="130px" alt="Europe">
                            <h3>Europe</h3>
                        </div>
                    </a>
                    <a href="#">
                        <div class="col continent px-3">
                            <img src="assets/img/oceanie.png" width="130px" alt="Océanie">
                            <h3>Océanie</h3>
                        </div>
                    </a>
                </div>
            </section>


            <h2 class="title">Derniers articles</h2>
            <section class="blog-slider">
                <ol>
                    <?php
                    $article = new Article($db);
                    $articles = $article->getArticlesPerPage(0, $articlesPerPage);
                    $articlesPerPage = 10;
                    foreach ($articles as $key => $article_item) { ?>
                        <li>
                            <div class="thumb ">
                                <img src="assets/uploads/<?= $article_item['image'] ?>" alt="<?= $article_item['titre'] ?>">
                                <div class="thumb-content">
                                    <h2><?= $article_item['titre'] ?></h2>
                                    <p><?= $article_item['date'] ?></p>
                                    <p><?= $article_item['summary'] ?></p>
                                    <?php echo '<a href="article.php?id=' . $article_item['id'] . '">Lire la suite</a>'; ?>
                                </div>
                            </div>
                        </li>
                </ol>
            <?php
                    } ?>

            </section>

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

    <!-- >Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>