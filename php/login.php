<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../includes/db.php');
include('../includes/check_session.php');


$username = $_POST['username'];
$password = $_POST['password'];

if ((!isset($_POST['username'])) || empty($_POST['username'])) {
    header('location: ../admin/login.php?message=Vous devez remplir tous les champs.&type=danger');
    exit;
}



if ((!isset($_POST['password'])) || empty($_POST['password'])) {
    header('location: ../admin/login.php?message=Vous devez remplir tous les champs.&type=danger');
    exit;
}


$sql = "SELECT username, password, id,role FROM users where username = :username AND password = :password";
$stmt = $db->prepare($sql);
$stmt->execute([
    'username'=>$username,
    'password'=> hash('sha256',$password),
]);
$res = $stmt->fetch();

if(!$res){
    header('location: ../admin/login.php?message=Identifiants incorrects.&type=danger');
    exit;
}
setcookie('id', $res['id'], time()+60*60*24*30, '/');
setcookie('password', $res['password'], time()+60*60*24*30, '/');
setcookie('role', $res['role'], time()+60*60*24*30,'/');


header('location: ../admin/panel.php');