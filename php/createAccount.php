<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';
$username = $_POST['username'];
$password = $_POST['password'];



//recuperation du mail pour voir si il existe déjà dans la bdd
$sql = "SELECT username FROM music_users WHERE username = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam('username', $username);
$stmt->execute();
$res = $stmt->fetch();

if($res){
    header('location: ../admin/accounts.php?message=Cet Username est déjà utilisé.&type=red');
    exit;
}


$stmt = $db->prepare("INSERT INTO music_users (username, password) VALUES (:username, :password)");
$stmt->execute(['username'=>$username, 'password' =>$password]);
header('location: ../admin/accounts.php?message=Compte crée avec succès.&type=green');
