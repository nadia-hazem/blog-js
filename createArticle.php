<?php 
session_start(); 
require_once 'assets/class/DbConnect.php'; 
require_once 'assets/class/User.php'; 
require_once 'assets/class/Article.php'; 
$db = new DbConnect(); 
$user = new User($db); 
$article = new Article($db); 

 //check if form is submitted  
if (isset($_POST['submit'])) {  

    //valider les data côté serveur
    $title = trim(strip_tags($_POST['title']));  
    $description = trim(strip_tags($_POST['description']));  
    $category = trim(strip_tags($_POST['continent']));  

    $errorMsg = '';

    //Vérifie que les champs ne sont pas vides 
    if (empty($title) || empty($description) || empty($continent)) {  

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
            $mimeType = finfo_file($finfo, $tmpFile);

            $allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/gif'
            ];

            //Vérifie que le fichier téléchargé ne dépasse pas 2MB    
            if (in_array($mimeType, $allowedTypes) && $file['size'] <= 4000000) {    
                $fileName = time() . '-' . $_FILES['image']['name'];    
                move_uploaded_file($tmpFile, "assets/img/$fileName");

                //insère data dans la bdd
                try {    
                    $request = "INSERT INTO articles (titre, description, continent, image) VALUES (:title, :description, :continent, :image)";
                    $insert = $this->db->prepare($request);

                    $insert->execute([
                        'title' => $title,
                        'description' => $description,
                        'continent' => $continent,
                        'image' => $newFileName
                    ]);
                
                    //si la data est insérée afficher message de succès et redirection
                    if ($insert) {
                        $_SESSION['success'] = "Article créé avec succès !";
                        header('Location: success.php');
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
<html lang="en">
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
            let input = event.target;
            let preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
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
                        <select name="category" id="category">
                            <option value="1">Europe</option>
                            <option value="2">Asie</option>
                            <option value="3">Afrique</option>
                            <option value="4">Amérique/Nord</option>
                            <option value="5">Amérique/Sud</option>
                            <option value="5">Océanie</option>
                        </select>
                    </div>

                    <label for="image">Télécharger une image</label>
                    <input type="file" id="image" name="image" accept="img/*">
                    
                    <input type="submit" value="Publier" name="create">

                </form>

            </div>

        </main>

        <div class="push"></div>

    </wrapper>
</body>
</html>