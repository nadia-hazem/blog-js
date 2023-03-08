<?php
SESSION_START();
require '../class/DbConnect.php';
require '../class/User.php';
$db = new DbConnect();
$user = new User($db);

// test si le login est dispo
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// inscription
if (isset($_POST['insc'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user->register($login, $password);
}

// connexion
if (isset($_POST['conn'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user->connect($login, $password);
}
