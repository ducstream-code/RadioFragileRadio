<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';
$list = $_GET['list'];
$idPlaylist = $_GET['idPL'];

$decodelist = json_decode($list);


foreach ($decodelist as $music){

    $sql = "INSERT INTO played_title (id_titre,id_playlist) VALUES (:id_titre, :id_playlist)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'id_titre'=> intval($music),
        'id_playlist' => intval($idPlaylist),
    ]);



}


