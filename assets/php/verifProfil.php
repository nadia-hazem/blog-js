<?php
// class include
session_start();
require_once '../class/DbConnect.php';
require_once '../class/User.php';

$db = new DbConnect();
$user = new User($db);

// test si le login est dispo
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// modification login
if (isset($_POST['modifLogin'])) {
    $login = $_POST['login'];
    $oldLogin = $_POST['oldLogin'];
    $password = $_POST['password'];
    $user->updateLogin($login, $oldLogin, $password);
}

// modification password
if (isset($_POST['modifPass'])) {
    $password = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $user->updatePassword($password, $newPassword);
}
