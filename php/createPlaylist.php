<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';
$list = $_GET['list'];
$idPlaylist = $_GET['idPL'];

$stmt = $db->prepare("SELECT duration FROM playlist WHERE id = :id");
$stmt->execute([
    'id'=>$idPlaylist,
]);
$duration = $stmt->fetch();

$durée = $duration['duration'];

$decodelist = json_decode($list);


foreach ($decodelist as $music){

    $sql = "INSERT INTO played_title (id_titre,id_playlist) VALUES (:id_titre, :id_playlist)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'id_titre'=> intval($music),
        'id_playlist' => intval($idPlaylist),
    ]);

    $stmt = $db->prepare("SELECT duration FROM musics WHERE id = :id");
    $stmt->execute([
        'id' => intval($music),
    ]);
    $musicDuration = $stmt->fetch();

    $durée += $musicDuration['duration'];
echo $durée;
}

$sql = "UPDATE playlist SET duration = $durée WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute([
    'id' => intval($idPlaylist),
]);




