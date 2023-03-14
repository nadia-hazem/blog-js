<header>
    <div class="logo">
        <a href="index.php"><img src="assets/img/trippy.png"></a>
    </div>

    <nav id="nav" class="close ">

        <!-- Burger menu -->
        <burgerButton class="open" onclick="burgerSwitch(this.parentNode);">
        </burgerButton>

        <!-- tester si l'utilisateur est connecté -->
        <?php
        if (isset($_GET['deconnexion'])) {
            if ($_GET['deconnexion'] == true) {
                $user->disconnect();
                header('Location: index.php');
            }
        }

        if ($user->isUserAdmin()) {
        ?>

            <ul class="top-menu">

                <li id="accueil" class=""><a class="" href="index.php">ACCUEIL</a></li>

                <li id="apropos" class=""><a class="" href="apropos.php">A PROPOS</a></li>

                <li id="profil" class=""><a class="" href="profil.php"></i>PROFIL</a></li>

                <li id="blog" class=""><a class="" href="blog.php">BLOG</a></li>

                <li id="admin" class=""><a class="" href="admin.php">ADMIN</a></li>

                <li id="deconnexion" class=""><a class="" href="index.php?deconnexion=true">DECONNEXION</a></li>

            </ul>
    </nav>

    <div class="currentUser">
        <p id="currentUser"><mark><?= $user->getLogin() ?></mark></p>
    </div>

<?php
        } else if ($user->isConnected()) {
?>

    <nav id="nav" class="close ">

        <ul class="">

            <li id="accueil" class=""><a class="" href="index.php">ACCUEIL</a></li>

            <li id="apropos" class=""><a class="" href="apropos.php">A PROPOS</a></li>

            <li id="profil" class=""><a class="" href="profil.php"></i>PROFIL</a></li>

            <li id="blog" class=""><a class="" href="blog.php">BLOG</a></li>

            <li id="deconnexion" class=""><a class="" href="index.php?deconnexion=true">DECONNEXION</a></li>

        </ul>
    </nav>

    <div class="currentUser">
        <p id="currentUser"><mark><?= $user->getLogin() ?></mark></p>
    </div>

<?php
        } else {
?>
    <nav id="nav" class="close ">

        <ul class="nav nav-pills nav-fill">

            <li id="accueil" class=""><a class="" href="index.php">ACCUEIL</a></li>

            <li id="apropos" class=""><a class="" href="apropos.php">A PROPOS</a></li>

            <li id="blog" class=""><a class="" href="blog.php">BLOG</a></li>

            <li id="logIn" class=""><a class="" id="loginBtn" href="forms.php?choice=login">CONNEXION</button></a></li>

            <li id="signIn" class=""><a class="" id="registerBtn" href="forms.php?choice=register">INSCRIPTION</a></li>

        </ul>
    <?php
        }
    ?>

    </nav>


</header>