<?php
include '../includes/db.php';
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = $_GET['id'];
$idPL = $_GET['idPl'];
//recalculating pl time

//getting music time
$stmt = $db->prepare("SELECT duration FROM musics WHERE id = :id");
$stmt->bindParam(':id',$id);
$stmt->execute();
$duration = $stmt->fetch();

//getting pl time
$stmt = $db->prepare("SELECT duration FROM playlist WHERE id = :idPl");
$stmt->bindParam(':idPl',$idPL);
$stmt->execute();
$durationPl = $stmt->fetch();

$newTime = $durationPl['duration'] - $duration['duration'];

//updating new time
$stmt = $db->prepare("UPDATE playlist SET duration = :duration WHERE id = :id ");
$stmt->bindParam(':duration',$newTime);
$stmt->bindParam(':id',$idPL);
$stmt->execute();


//removing the music from playlist
$stmt = $db->prepare("DELETE FROM played_title WHERE id_titre = :idTitre AND id_playlist = :idPl");
$stmt->execute(['idTitre'=>$id,
    'idPl'=>$idPL]);

