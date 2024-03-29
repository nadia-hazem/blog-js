<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$categInt = 0;
$articles = $article->getArticlesPerPage(0, 5, $categInt);
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
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/blog-js/assets/img/favicon.png"/>   
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/slider.css">
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
    <!-- Slider -->
    <script src="assets/js/slider.js"></script>

</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="wrapper">
        <main>

            <!-- SLIDER -->
            <div id="slider">
                <?php
                $articles = $article->getArticlesPerPage(0, 6, $categInt);
                foreach ($articles as $key => $article) { ?>
                    <div class="slide">
                        <a href="article.php?id=<?=$article['id']?>"><img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                            <div class="caption bg-dark">
                                <h1 class="text-white"><?= $article['titre'] ?></h1>
                                <p class="text-white"><small><?= $article['date'] ?></small></p>
                                <p class="text-white"><small><?= $article['categ'] ?></small></p>
                                <a href="article.php?id=<?= $article['id'] ?>">Lire la suite</a>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <div class="text-center">
                    <div class="next"><a onclick="return false;"><i class="fas fa-3x fa-chevron-right text-white"></i></a></div>
                    <div class="prev"><a onclick="return false;"><i class="fas fa-3x fa-chevron-left text-white"></i></a></div>
                </div>
            </div> <!-- /slider -->


            <section class="">
                <div class="container col">
                    <h1 class="franklin title" data-aos="zoom-in">Trippy Le blog de voyage</h1>
                    <div class="row wrap indextext">
                        <div class="col colcenter" data-aos="fade-up-right">
                            <img src="assets/img/stamp.png" class="" width="300px" alt="Tampons de douane">
                        </div>
                        <div class="col mt-3" data-aos="fade-up-left">
                            <h3>Si vous êtes passionné(e) de voyage et que vous cherchez des idées d'itinéraires, des astuces pour économiser de l'argent et des conseils pour découvrir des endroits incroyables dans le monde entier, vous êtes au bon endroit !</h3>
                            <p>En parcourant notre blog, vous découvrirez des récits de voyages passionnants, des astuces pour voyager à petit budget, des guides et des conseils pour la sécurité en voyage et bien plus encore.</p>
                            <p>Vous trouverez ici une mine d'informations pour vous aider à planifier votre prochaine aventure.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container my-5">
                    <h2 class="double py-5">Conseils de voyage</h2>

                    <div class="row wrap">
                        <div class=" colcenter relative border-white cardimg mx-1" data-aos="fade-right" data-aos-duration="1300">
                            <div class="hoverlayer"></div>
                            <a href="#"><img src="assets/img/1.png" alt="guide">
                                <div class="absolute-text">
                                    <h3 class="text-center text-shadow my-1">Guide voyage</h3>
                                </div>
                            </a>
                        </div> <!-- /col -->

                        <div class=" relative border-white cardimg mx-1" data-aos="flip-up" data-aos-duration="1300">
                            <div class="hoverlayer"></div>
                            <a href="#"><img src="assets/img/2.png" alt="inspiration">
                                <div class="absolute-text">
                                    <h3 class="text-center my-1">Inspirations</h3>
                                </div>
                            </a>
                        </div> <!-- /col -->

                        <div class=" relative border-white cardimg mx-1" data-aos="fade-left" data-aos-duration="1300">
                            <div class="hoverlayer"></div>
                            <a href="#"><img src="assets/img/3.png" alt="bons plans">
                                <div class="absolute-text">
                                    <h3 class="text-center my-1">Bons plans</h3>
                                </div>
                            </a>
                        </div> <!-- /col -->
                    </div> <!-- /row -->
                </div> <!-- /container -->
            </section>

            <section class="bg-sable h-50 mb-4">
                <h2 class="py-2">Destinations</h2>

                <div class="row wrap py-2">

                    <a href="blog.php?categInt=3">
                        <div class="col continent px-2">
                            <img src="assets/img/afrique.png" width="130px" alt="Afrique">
                            <h3>Afrique</h3>
                        </div>
                    </a>
                    <a href="blog.php?categInt=1">
                        <div class="col continent px-2">
                            <img src="assets/img/ameriquenord.png" width="130px" alt="Amérique du Nord">
                            <h3>Amérique/Nord</h3>
                        </div>
                    </a>
                    <a href="blog.php?categInt=2">
                        <div class="col continent px-2">
                            <img src="assets/img/ameriquesud.png" width="130px" alt="Amérique du Sud">
                            <h3>Amérique/Sud</h3>
                        </div>
                    </a>
                    <a href="blog.php?categInt=4">
                        <div class="col continent px-2">
                            <img src="assets/img/asie.png" width="130px" alt="Asie">
                            <h3>Asie</h3>
                        </div>
                    </a>
                    <a href="blog.php?categInt=5">
                        <div class="col continent px-2">
                            <img src="assets/img/europe.png" width="130px" alt="Europe">
                            <h3>Europe</h3>
                        </div>
                    </a>
                    <a href="blog.php?categInt=6">
                        <div class="col continent px-2">
                            <img src="assets/img/oceanie.png" width="130px" alt="Océanie">
                            <h3>Océanie</h3>
                        </div>
                    </a>
                </div>
                <br>
            </section>

            <h2 class="title py-2">Derniers articles</h2>
            <section>
                <ul class="blog-cards row wrap">
                    <?php
                    $article = new Article($db);
                    $articles = $article->getArticlesPerPage(0, $articlesPerPage, $categInt);
                    $articlesPerPage = 4;
                    foreach ($articles as $key => $article_item) {
                    ?>
                    <li>
                        <div class="thumb">
                            <img src="assets/uploads/<?= $article_item['image'] ?>" alt="<?= $article_item['titre'] ?>">
                            <div class="thumb-content">
                                <h2><?= $article_item['titre'] ?></h2>
                                <p><b><i>Publié le</i> <span class="text-sablefonce"><?= $article_item['date'] ?></span></b></p>
                                <p><b><i>Catégorie</i> : <span class="text-turquoise"><?= $article_item['categ'] ?></span></b></p>
                                <p><?= $article_item['summary'] ?></p>
                                <?php echo '<a href="article.php?id=' . $article_item['id'] . '"><b>Lire la suite</b></a>'; ?>
                            </div>
                        </div>
                    </li>
                    <?php
                    } ?>

                </ul>
            </section>
        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

    <!-- Animations AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- >Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>