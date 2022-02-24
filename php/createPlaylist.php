<?php

include '../includes/db.php';
$list = $_GET['list'];
$idPlaylist = $_GET['idPL'];
$plCount = 0;
if (!isset($idPlaylist) || empty($idPlaylist)) { //verify if $username is set
    echo 'You must choose a playlist';
    exit;
}

if (!isset($_GET['date']) || empty($_GET['date'])) { //verify if $username is set
    echo 'A date is required to create a playlist';
    exit;
}


$date = str_replace("T"," ",$_GET['date']);
$date = strtotime($date); //date de début playlist
$durée = 0;
$decodelist = json_decode($list);

//comptage du nombre de playlist

$stmt = $db->prepare("SELECT id FROM playlist");
$stmt->execute();
$nbPl = $stmt->rowCount();




foreach ($decodelist as $musicTime){
    $stmt = $db->prepare("SELECT duration FROM musics WHERE id = :id");
    $stmt->execute([
        'id' => intval($musicTime),
    ]);
    $musicDuration = $stmt->fetch();

    $durée += $musicDuration['duration'];
}
// $durée = durée total de la playlist
//$dateFin = gmdate("Y-m-d H:i:s",$date + $durée); //date de fin de la playlist
$dateFin = $date + $durée; //date de fin de la playlist Unix time (easier for calculus



//Recupération de toutes les dates et durée des playlists

$stmt = $db->prepare("SELECT Time, duration FROM playlist ");
$stmt->execute();
$existingDate = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($existingDate as $key => $existDate){
    if($existDate['Time'] == NULL){
        $plCount +=1;

    }else {
        $dateBegin = strtotime($existDate['Time']); //date debut playlist existante (unix time )
        $dateEnding = $existDate['duration'] + $dateBegin; //date de fin playlist existante (Unix TIME
        if($date >= $dateBegin && $date <= $dateEnding || $dateFin>=$dateBegin && $dateFin <= $dateEnding){
            echo 'Date unavailable';
            exit;
        }else{

        }
    }
}
foreach ($decodelist as $music){

    $sql = "INSERT INTO played_title (id_titre,id_playlist) VALUES (:id_titre, :id_playlist)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'id_titre'=> intval($music),
        'id_playlist' => intval($idPlaylist),
    ]);
}


$formatedDate = gmdate("Y-m-d H:i:s",$date); //date de fin de la playlist
//insert begining time in the database
$stmt = $db->prepare("UPDATE playlist SET Time = :Time WHERE id = :id ");
$stmt->bindParam(':Time',$formatedDate);
$stmt->bindParam(':id',$idPlaylist);
$stmt->execute();

//inserting duration in db
$stmt = $db->prepare("UPDATE playlist SET duration = :duration WHERE id = :id ");
$stmt->bindParam(':duration',$durée);
$stmt->bindParam(':id',$idPlaylist);
$stmt->execute();

echo 'ok';

//       echo gmdate("Y-m-d H:i:s",$beginDate);

