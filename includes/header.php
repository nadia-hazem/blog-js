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

                <li id="accueil"><a href="index.php">ACCUEIL</a></li>

                <li id="apropos"><a href="apropos.php">A PROPOS</a></li>

                <li id="profil"><a href="profil.php">PROFIL</a></li>

                <li id="blog"><a href="blog.php">BLOG</a></li>

                <li id="admin"><a href="admin.php">ADMIN</a></li>

                <li id="deconnexion"><a href="index.php?deconnexion=true">DECONNEXION</a></li>

            </ul>
    </nav>

    <div class="currentUser">
        <p id="currentUser"><mark><?= $user->getLogin() ?></mark></p>
    </div>

    <?php
            } else if ($user->isConnected()) {
    ?>

    <nav id="nav" class="close ">

        <ul>

            <li id="accueil"><a href="index.php">ACCUEIL</a></li>

            <li id="apropos"><a href="apropos.php">A PROPOS</a></li>

            <li id="profil"><a href="profil.php">PROFIL</a></li>

            <li id="blog"><a href="blog.php">BLOG</a></li>

            <li id="deconnexion"><a href="index.php?deconnexion=true">DECONNEXION</a></li>

        </ul>
    </nav>

    <div class="currentUser">
        <p id="currentUser"><mark><?= $user->getLogin() ?></mark></p>
    </div>

    <?php
            } else {
    ?>
    <nav id="nav" class="close ">

        <ul>

            <li id="accueil"><a href="index.php">ACCUEIL</a></li>

            <li id="apropos"><a href="apropos.php">A PROPOS</a></li>

            <li id="blog"><a href="blog.php">BLOG</a></li>

            <li id="logIn"><a id="loginBtn" href="forms.php?choice=login">CONNEXION</button></a></li>

            <li id="signIn"><a id="registerBtn" href="forms.php?choice=register">INSCRIPTION</a></li>

        </ul>
    <?php
        }
    ?>

    </nav>

</header>
