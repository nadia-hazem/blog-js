<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);
$categInt = 0;

?>

<!--<!DOCTYPE html>-->

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
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

    <style>
        #slider {
            position: relative;
            height: 80vh;
            width: 100%;
            overflow: hidden!important;
            display: flex;
            justify-content: center;
        }
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            transition: all 0.5s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transform: translateX(100%);
            transition: ease-in-out 1s;
        }
        .slide.active {
            z-index: 1;
            opacity: 1;
            transform: translate(0%);
        }
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }
        .next, .prev {
            position: absolute;
            height: 100px;
            width: 100px;
            color: white;
            opacity: .8;
            cursor: pointer;
        }
        .next {
            right: 0;
            top: 50%;
            z-index: 2;
        }
        .prev {
            left: 0;
            top: 50%;
            z-index: 2;
        }
        .caption {
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            color: #fff!important;
        }


    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('#slider');
        const slides = slider.querySelectorAll('.slide');
        const captions = slider.querySelectorAll('.caption');
        const next = slider.querySelector('.next');
        const prev = slider.querySelector('.prev');
        let currentSlide = 0;

        slides[currentSlide].classList.add('active');
        console.log(slides.length);

        function goToSlide(moveTo) {

            slides[currentSlide].classList.remove('active');

            currentSlide = (moveTo + slides.length) % slides.length;
            console.log(currentSlide);

            slides[currentSlide].classList.add('active');
        }


        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        function prevSlide() {
            goToSlide(currentSlide - 1);
        }

        next.onclick = function() {
            nextSlide();
        };
        prev.onclick = function() {
            prevSlide();
        };

        setInterval(nextSlide, 4000);
        });

    </script>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="wrapper">
        <main>
        <div id="slider">
            <?php
            $articles = $article->getArticlesPerPage(0, 6, $categInt);
            foreach ($articles as $key => $article) { ?>
                <div class="slide">
                    <a href="article.php?id=<?=$article['id']?>"><img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                        <div class="caption">
                            <h1 class="text-white"><?= $article['titre'] ?></h1>
                            <p><?= $article['date'] ?></p>
                            <p><small>Catégorie : </small><?= $article['categ'] ?></p>
                            <a href="article.php?id=<?= $article['id'] ?>">Lire la suite</a>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="text-center">
                <div class="next"><a onclick="return false;"><i class="fas fa-2x fa-chevron-right"></i></a></div>
                <div class="prev"><a onclick="return false;"><i class="fas fa-2x fa-chevron-left"></i></a></div>
            </div>
        </div> <!-- /slider -->

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