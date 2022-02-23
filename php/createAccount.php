<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';
$username = $_POST['username'];
$password = $_POST['password'];


if ((!isset($username)) || empty($username)) { //verify if $username is set
    header('location: /admin/accounts.php??message=Un username est necessaire.&type=danger');
    exit;
}

if ((!isset($password)) || empty($password)) { //verify if $password is set
    header('location: /admin/accounts.php??message=Un mot de passe est necessaire.&type=danger');
    exit;
}


//recuperation du mail pour voir si il existe déjà dans la bdd
$sql = "SELECT username FROM users WHERE username = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam('username', $username);
$stmt->execute();
$res = $stmt->fetch();

if($res){
    header('location: ../admin/accounts.php?message=Cet Username est déjà utilisé.&type=red');
    exit;
}


$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->execute(['username'=>$username, 'password' =>hash('sha256',$password)]);
header('location: ../admin/accounts.php?message=Compte crée avec succès.&type=green');
