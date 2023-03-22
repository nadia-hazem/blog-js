<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);

// verify if user is mode or admin
if (!$user->isUserMode()) {
    header('Location: index.php');
}

//check if form is submitted  
if (isset($_POST['create'])) {

    //valider les data côté serveur
    $title = trim(strip_tags($_POST['title']));
    $description = trim($_POST['description']);
    $categorie = trim(strip_tags($_POST['categorie']));

    $errorMsg = '';

    //Vérifie que les champs ne sont pas vides 
    if (empty($title) || empty($description) || empty($categorie)) {

        var_dump($_POST);
        //message d'erreur si un des champs est vide  
        $errorMsg = "Tous les champs sont requis.";
    } else {

        //Si tous les champs sont remplis, vérifie si une img est uploadée et procède en conséquence   

        if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {

            //Récupère le nom de l'image et son chemin temporaire    
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            // vérifir le type de fichier téléchargé
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $_FILES['image']['tmp_name']);

            $tmp_name = $_FILES['image']['tmp_name'];
            $name = basename($_FILES['image']['name']);


            $allowedTypes = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/gif'
            ];

            //Vérifie que le fichier téléchargé ne dépasse pas 4MB    
            if (in_array($mimeType, $allowedTypes) && $_FILES['image']['size'] <= 4000000) {
                // $fileName = time() . '-' . $_FILES['image']['name'];

                move_uploaded_file($tmp_name, "assets/uploads/$fileName");

                //insère data dans la bdd
                try {
                    $insert = $article->createArticle($title, $description, $categorie, $fileName);

                    //si la data est insérée afficher message de succès et redirection
                    if ($insert == "ok") {
                        $_SESSION['success'] = "Article créé avec succès !";
                        header('Location: blog.php');
                    } else {
                        $errorMsg = "Erreur lors de la création de l'article.";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                $errorMsg = "Veuillez sélectionner une image valide.";
            }
        } else {
            $errorMsg = "Veuillez sélectionner une image.";
        }
    }
}
?>

<!------------ <!DOCTYPE html> ------------>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Article</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Libre+Franklin:wght@100&family=Oswald:wght@300&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>
    <!-- TinyMCE -->
    <script src="assets/js/tinymce.min.js" type="text/javascript"></script>


    <script>
        function previewImage(event) {
            console.log('previewImage() function called')
            let input = event.target;
            let preview = document.createElement('img');
            preview.setAttribute('id', 'preview');
            // ajouter l'image à la suite de l'input
            input.parentNode.insertBefore(preview, input.nextSibling);
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    console.log(preview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>

<body id="create">

    <?php
    include 'includes/header.php';
    $categories = $article->getCategories();
    ?>

    <wrapper>

        <main>
            <div class="container">

                <h1 class="title" data-aos="fade-in">Créer un article</h1>

                <!-- Affiche les messages d'erreur et de succès -->
                <?php
                if (isset($errorMsg)) {
                    echo '<p class="error">' . $errorMsg;
                    echo '</p>';
                } elseif (isset($successMsg)) {
                    echo '<p class="success">' . $successMsg;
                    echo '</p>';
                }
                ?>
                <form method="post" enctype="multipart/form-data" class=" w-50" data-aos="zoom-in">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <label for="category">Catégorie</label>
                        <select name="categorie" id="category">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['categorie'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <label for="image">Télécharger une image</label>
                    <input type="file" id="image" name="image" accept="img/*" onchange="previewImage(event)">


                    <input type="submit" value="Publier" name="create" class="btn" onclick="ajouter()">


                </form>

            </div>

        </main>

        <div class="push"></div>

    </wrapper>


    <!-- TinyMCE textarea-editor-->
    <script type="text/javascript" language="javascript">
        tinymce.init({
            selector: "textarea",
            height: 370,
            menubar: false,
            statusbar: false,

            style_formats: [{
                title: 'Headings',
                items: [{
                        title: 'Heading 1',
                        format: 'h3'
                    },
                    {
                        title: 'Heading 2',
                        format: 'h4'
                    },
                    {
                        title: 'Heading 3',
                        format: 'h5'
                    },
                    {
                        title: 'Heading 4',
                        format: 'h6'
                    }
                ]
            }]
        });

        function ajouter() {
            tinymce.triggerSave(true, true);
        }
    </script>

    <!-- Animations AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>