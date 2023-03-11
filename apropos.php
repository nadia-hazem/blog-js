<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
$db = new DbConnect();
$user = new User($db);
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Propos</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>

</head>
<body id="apropos">
    
    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main>

            <section class="hero">

                <h1>A Propos</h1>

            </section>
            
            <h5 class="text-center text-mute">Développé par Nadia et Thomas</h5>

            <div class="container"> <!-- Présentation -->
                <div class="row">
                    <div class="col col-50 text-mute p-3 franklin">                    
                        <p>Ce site est un projet de formation en développement web dans le cadre de la formation de développeur web, Titre RNCP5 au sein du Campus numérique de "La Plateforme_". C'est un projet en groupe de 2 personnes, réalisé par <a href="https://github.com/nadia-hazem/blog-js" target="_blank">Nadia Hazem</a> et <a href="https://github.com/thomas-spinec/blog-js" target="_blank">Thomas Spinec.</a></p>
                        <p>L'objectif est de mettre en pratique nos compétences en matière de code et création de sites web et de vous offrir une expérience de navigation agréable.</p>
                    </div>
                    <div class="col col-50 colcenter">
                        <a href="https://laplateforme.io/" target="_blank"><img class=""src="assets/img/logo_laplateforme_bleu3.png" width="300px" alt="logo plateforme"></a>
                    </div>
                </div>
            </div> <!-- /container -->

            <div class="container mt-0"> <!-- Présentation du projet -->

                <div class="row m-3 "> 
                    <div class="col-33 card bg-light p-1 m-2">
                        <h2 class="text-center">Le sujet</h2>
                        <p>Il s'agit de réaliser un blog avec les langages suivants :</p>
                        <ul><li>HTML</li><li>CSS</li><li>PHP</li><li>SQL</li><li>Javascript</li></ul>
                    </div>
                    <div class="col-33 card bg-light p-1 m-2">
                        <h2 class="text-center">Compétences visées</h2>
                        <ul>
                            <li>Architecture de base de données : MCD / MLD / MPD</li>
                            <li>Architecture backend en classe </li>
                            <li>Interface responsive</li>
                            <li>Programmation asynchrone en Javascript</li>
                            <li>Utilisation des paramètre de l’URL</li>
                        </ul>
                    </div>
                    <div class="col-33 card bg-light p-1 m-2">
                        <h2 class="text-center">Compétences du REAC validées</h2>
                        <ul>
                            <li>Développer une interface utilisateur web dynamique</li>
                            <li>Réaliser une interface utilisateur avec une solution de gestion de contenu</li>
                            <li>Créer une base de données</li>
                            <li>Développer les composants d’accès aux données</li>
                            <li>Développer la partie back-end d’une application web ou web mobile</li>
                        </ul>
                    </div>
                </div> <!-- /row -->
            </div> <!-- /container -->

            <div class="container"> <!-- Descriptif du projet -->

                <section class="description bg-light p-5 radius shadow">

                    <h2>Descriptif du projet</h2>

                    <p>Créer un blog afin de publier des articles personnels et d’échanger avec
                    les visiteurs. Choix du thème du blog, libre. Travailler l’esthétique pour
                    avoir le rendu le plus professionnel possible.</p>
                    <p>Voici la liste des fonctionnalités que tout blog digne de ce nom se doit d'avoir :</p>
                    <ul>
                        <li>Une page d'accueil : Elle contient les derniers articles mis en ligne et quelques call-to-actions.</li>
                        <li>Une page permettant aux utilisateurs de s'authentifier. Faire apparaître un formulaire de connexion et d'inscription au clic d'un bouton. L'inscription doit se faire avec une requête asynchrone et les vérifications des formulaires doivent être faites en front et en back.</li>
                        <li>Une fois inscrit et connecté, vous êtes redirigé vers une page affichant les informations du profil. L'utilisateur doit pouvoir modifier ses informations et ce sans rechargement de page.</li>
                        <li>Une page qui présente les différents articles du blog. La page présente un nombre limité d'articles (entre 5 et 20) avec une pagination pour voir les autres articles. Cette pagination doit se faire avec un paramètre GET dans la requête (exemple : ?page=1).</li>
                        <li>Une page qui permet de créer des articles : La page est accessible uniquement aux personnes qui possèdent les rôles permettant de rédiger un article (modérateurs et administrateurs). Chaque article est lié à une catégorie.</li>
                        <li>Une page qui affiche le contenu d’un article et les commentaires associés : La récupération de l’article est gérée via un paramètre dans la requête GET (ex :
                        ?article=1). Cette page est donc une template remplie avec les informations de
                        l’article correspondant à chaque fois.</li>
                        <li>Une page d’administration : Ce panel admin permet aux administrateurs de votre site de gérer l’ensemble des utilisateurs, articles, commentaires, catégories, droits, etc.</li>
                        <li>Toutes les pages doivent présenter un header et un footer contenant les mêmes liens et ayant les mêmes informations.</li> 
                    </ul>
                    
                    </p>
                
                </section>

                <h4 class="text-center m-5"> Le projet est visible sur nos portfolios respectifs </h4>
                <div class="row">
                    <div class="col col-50 text-center">
                        <a href="https://github.com/nadia-hazem/blog-js"><img src="assets/img/logo-nadia.png" width="50px">&nbsp; &nbsp; https://github.com/nadia-hazem/blog-js</a>
                    </div>
                    <div class="col col-50 text-center">
                        <a href="https://github.com/thomas-spinec/blog-js"><img src="assets/img/logo-thomas.png" width="100px">https://github.com/thomas-spinec/blog-js</a>                    
                    </div>
                </div> <!-- /row -->
            </div>
        </main>

        <div class="push"></div>

    </div>

    <?php include 'includes/footer.php'; ?>

</body>
</html>