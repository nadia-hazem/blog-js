<?php
session_start();
require_once '../class/DbConnect.php';
require_once '../class/User.php';
require_once '../class/Article.php';

$db = new DbConnect();
$user = new User($db);
$article = new Article($db);

// affichage de la div
if (isset($_GET['id'])) :
    $id = $_GET['id'];
    $item = $article->getArticle($id);
    $likes = $item['likes'];
    $dislikes = $item['dislikes'];

?>
    <div class="voteBar">
        <div class="voteProgress" style="width:<?= ($likes + $dislikes) == 0 ? 100 : round(100 * ($likes / ($likes + $dislikes))) ?>%"></div>
    </div>
    <div class="voteBtns">
        <a class="voteBtn like" data-id="<?= $id ?>"><i class="fas fa-thumbs-up like"></i><?= $likes ?></a>
        <a class="voteBtn dislike" data-id="<?= $id ?>"><i class="fas fa-thumbs-down dislike"></i><?= $dislikes ?></a>
    </div>
<?php
endif;

// traitement des votes
if (isset($_POST['like'])) :
    $id_article = $_POST['id_article'];
    $id_user = $user->getId();
    // si déconnecté message
    if ($id_user == 0) :
        echo 'déconnecté';
    else :
        echo $article->like($id_article, $id_user);
    endif;
elseif (isset($_POST['dislike'])) :
    $id_article = $_POST['id_article'];
    $id_user = $user->getId();
    // si déconnecté message
    if ($id_user == 0) :
        echo 'déconnecté';
    else :
        echo $article->dislike($id_article, $id_user);
    endif;
endif;

// update des votes
if (isset($_POST['update'])) :
    $id_article = $_POST['id_article'];
    echo $article->updateLikes($id_article);
endif;

// vérification si l'utilisateur a déjà voté
if (isset($_POST['color'])) :
    $id_article = $_POST['id_article'];
    $id_user = $user->getId();
    echo $article->checkVote($id_article, $id_user);
endif;
