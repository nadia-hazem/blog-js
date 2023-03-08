<header>
    <nav class="close" id="nav">

        <!-- Burger menu -->
        <burgerButton class="open" onclick="burgerSwitch(this.parentNode);">
        </burgerButton>

        <!-- tester si l'utilisateur est connecté -->
        <?php
        if (isset($_GET['deconnexion'])){
            if($_GET['deconnexion']==true){
                $user->disconnect();
                header('Location: index.php');
            }
        }
        else if ($user->isConnected()) {
            
            echo '
            <ul class="">

                <li class=""><mark><?= $user->getLogin() ?></mark></li>

                <li id="accueil" class=""><a class="text-white" href="index.php">ACCUEIL</a></li>

                <li id="profil" class=""><a class="text-white" href="profil.php"></i>PROFIL</a></li> 

                <li id="livre" class=""><a class="text-white" href="blog.php">BLOG</a></li>

                <li id="deconnexion" class=""><a class="text-white" href="index.php?deconnexion=true">DECONNEXION</a></li>

            </ul> ';

            } else { 

                echo '
                <ul class="nav nav-pills nav-fill">

                    <li id="accueil" class=""><a class="text-white" href="index.php">ACCUEIL</a></li>

                    <li id="blog" class=""><a class="text-white" href="blog.php">BLOG</a></li>

                    <li id="logIn" class=""><a class="text-white" id="loginBtn" href="forms.php?choice=login">CONNEXION</button></a></li>

                    <li id="signIn" class=""><a class="text-white" id="registerBtn" href="forms.php?choice=register">INSCRIPTION</a></li>

                </ul> ';

        }   
        ?>

    </nav>


</header>