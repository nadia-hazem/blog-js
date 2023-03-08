<?php
session_start();
require_once 'assets/class/DbConnect.php';
require_once 'assets/class/User.php';
require_once 'assets/class/Article.php';
$db = new DbConnect();
$user = new User($db);
$article = new Article($db);

// Ajoute un écouteur d'événements pour le téléchargement de fichiers
?>

<!-- <!DOCTYPE html> -->
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
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <wrapper>

        <main>
            <div class="container">

                <form action="" method="post">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title" required>

                    <label for="content">Content</label>
                    <textarea name="content" id="articleContent" cols="30" rows="10" placeholder="Content" required></textarea>

                    
                    <label for="image-upload">Télécharger une image:</label>
                    <input type="file" id="image-upload" accept="image/*">
                    
            


                    <input type="submit" value="Create" name="create">

                </form>

            </div>

        </main>

        <div class="push"></div>

    </wrapper>
</body>
</html>