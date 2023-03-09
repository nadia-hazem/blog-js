<?php 
session_start(); 
require_once 'assets/class/DbConnect.php'; 
require_once 'assets/class/User.php'; 
require_once 'assets/class/Article.php'; 
$db = new DbConnect(); 
$user = new User($db); 
$article = new Article($db); 

//check if form is submitted  
if (isset($_POST['create'])) {  
    
    //valider les data côté serveur
    $title = trim(strip_tags($_POST['title']));  
    $description = trim(strip_tags($_POST['description']));  
    $continent = trim(strip_tags($_POST['continent']));  
    
    $errorMsg = '';
    
    //Vérifie que les champs ne sont pas vides 
    if (empty($title) || empty($description) || empty($continent)) {  
        
        var_dump($_POST);
        //message d'erreur si un des champs est vide  
        $errorMsg = "Tous les champs sont requis.";  

    } else {  

        //Si tous les champs sont remplis, vérifie si une img est uploadée et procède en conséquence   

        if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {    

            //Récupère le nom de l'image et son chemin temporaire    
            $fileName = $_FILES['image']['name'];    
    
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
                move_uploaded_file($tmp_name, "assets/uploads/$name");

                //insère data dans la bdd
                try {    
                    $insert = $article->createArticle($title, $description, $continent, $fileName);
                
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
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/menu.js"></script>

    <script>
        function previewImage(event) {
            console.log('previewImage() function called')
            let input = event.target;
            let preview = document.getElementById('preview');
            /* preview.style.whidth = '300px';
            preview.style.height = '200px'; */
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

<body>

    <?php include 'includes/header.php'; ?>
    
    <wrapper>

        <main>
            <div class="container">
                <h1>Créer un article</h1>
                <!-- Affiche les messages d'erreur et de succès -->
                <?php
                if (isset($errorMsg)) {
                    echo '<p class="error">'. $errorMsg; 
                    echo'</p>';
                } 
                elseif (isset($successMsg)) {
                    echo '<p class="success">' . $successMsg; 
                    echo'</p>';
                } 
                ?>
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" required>
                    </div>
                    <div>
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" required></textarea>
                    </div>
                    <div>
                        <label for="category">Catégorie</label>
                        <select name="continent" id="category">
                            <option value="Europe">Europe</option>
                            <option value="Asie">Asie</option>
                            <option value="Afrique">Afrique</option>
                            <option value="Amérique/Nord">Amérique/Nord</option>
                            <option value="Amérique/Sud">Amérique/Sud</option>
                            <option value="Océanie">Océanie</option>
                        </select>
                    </div>

                    <label for="image">Télécharger une image</label>
                    <input type="file" id="image" name="image" accept="img/*" onchange="previewImage(event)">

                    <img id="preview" src="" alt="Image preview">

                    
                    <input type="submit" value="Publier" name="create">

                </form>

            </div>

        </main>

        <div class="push"></div>

    </wrapper>
</body>
</html>