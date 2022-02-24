<?php

include '../includes/db.php';
$username = $_POST['username'];
$name = $_POST['name'];
/*
$date = str_replace("T"," ",$_POST['date']);
$date = strtotime($date);
*/

if ((!isset($username)) || empty($username)) { //verify if $username is set
    header('location: /admin/panel.php?message=Un username est necessaire.&type=danger');
    exit;
}
if ((!isset($name)) || empty($name)) { //verify if $username is set
    header('location: /admin/panel.php?message=Un nom de Playlist est necessaire.&type=danger');
    exit;
}




//recuperation du mail pour voir si il existe déjà dans la bdd
$sql = "SELECT name FROM playlist WHERE name = :name";
$stmt = $db->prepare($sql);
$stmt->bindParam('name', $name);
$stmt->execute();
$res = $stmt->fetch();

if($res){
    header('location: ../admin/panel.php?message=Nom de playlist déjà utilisé&type=red');
    exit;
}


$stmt = $db->prepare("INSERT INTO playlist (name, username) VALUES (:name, :username)");
$stmt->execute([
    'name'=>$name,
    'username' =>$username,
]);
header('location: ../admin/panel.php?message=Playlist créée avec succès.&type=green');
