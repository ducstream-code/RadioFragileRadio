<?php

include '../includes/db.php';


if (!isset($_GET['date']) || empty($_GET['date'])) { //verify if $username is set
    echo 'A date is required to create a playlist';
    exit;
}

$idPl = $_GET['idPl'];
$date = str_replace("T"," ",$_GET['date']);
$date = strtotime($date); //date de début playlist



//comptage du nombre de playlist

$stmt = $db->prepare("SELECT id FROM playlist");
$stmt->execute();
$nbPl = $stmt->rowCount();

//pour chaque playlist existante on récupere le début et la fin en unix time

$stmt = $db->prepare("SELECT Time, duration FROM playlist");
$stmt->execute();
$plDates = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($plDates as $key => $plDate){
    //début de la playlist
   $unixBegin =  strtotime($plDate['Time']);
    //fin de la playlist
    $unixEnd = $unixBegin + $plDate['duration'];

    //on va prendre le début de la playlist a modifié et a chaque fois ajouter le temps d'une musique, si le unix time
    // est dans l'encadrement on exit
    $stmt = $db->prepare("SELECT id_titre FROM played_title WHERE id_playlist = :idPl");
    $stmt->execute(['idPl'=>$idPl]);
    $musicInPl = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $startmusic = $date;

    foreach ($musicInPl as $key => $plms){
        $stmt = $db->prepare("SELECT duration FROM musics WHERE id = :id");
        $stmt->execute(['id'=>$plms['id_titre']]);
        $musicDuration = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($musicDuration as $key => $msTime){
            $startmusic +=$msTime['duration'];
            if($date >= $unixBegin && $date <= $unixEnd || $startmusic > $unixBegin && $startmusic < $unixEnd){
                echo 'Date Unavailable';
                exit;
            }
        }
    }
}
echo 'ok';
$stmt = $db->prepare("UPDATE playlist SET Time = :date WHERE id = :idPl ");
$stmt->execute([
    'date' => gmdate("Y-m-d H:i:s",$date),
    'idPl' => $idPl,
]);


