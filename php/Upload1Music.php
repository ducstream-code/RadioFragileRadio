<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../class/MP3File.php";
include "../includes/db.php";
$currentDir = getcwd();

$title = $_POST['titleAjax'];
$artist = $_POST['artistAjax'];
$album = $_POST['albumAjax'];
$year = $_POST['yearAjax'];
$genre = htmlspecialchars($_POST['genreAjax']);

if ((!isset($title)) || empty($title)) { //verify if $username is set
    echo 'Un titre est necessaire';
    exit;
}
if ((!isset($artist)) || empty($artist)) { //verify if $username is set
    echo 'Un artiste est necessaire';
    exit;
}
if ((!isset($album)) || empty($album)) { //verify if $username is set
    echo 'Un album est necessaire';
    exit;
}
if ((!isset($year)) || empty($year)) { //verify if $username is set
    echo 'Une année est necessaire';
    exit;
}
if ((!isset($genre)) || empty($genre)) { //verify if $username is set
    echo 'Un genre est necessaire';
    exit;
}

if (!isset($_FILES['fileAjax']) && empty($_FILES['fileAjax']['name'])) {
    echo 'Vous devez choisir un fichier';
    exit;
}




$fileName = $_FILES['fileAjax']['name'];

$fileExtension = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

$fileTmpName  = $_FILES['fileAjax']['tmp_name'];

$splitname = explode('.', $fileName);
$ext = end($splitname);
$finalName = 'music_'.time().'.'.$ext;
if ($fileExtension != 'mp3'){
    echo 'Only .mp3 files are allowed';
}
$uploadPath = "../uploads/" . basename($finalName);
if (!move_uploaded_file($fileTmpName, $uploadPath)) {
    echo 'error';
    exit;
}else{
    echo 'Music uploaded';
    $mp3file = new MP3File($uploadPath);
    $duration = $mp3file->getDurationEstimate();
    $stmt = $db->prepare("INSERT INTO musics (title,artist,album,date,genre,location,duration) VALUES (:title, :artist, :album,:date,:genre,:location,:duration)");
    $stmt->execute([
        'title'=> $title,
        'artist'=>$artist,
        'album'=>$album,
        'date'=>$year,
        'genre'=>$genre,
        'location'=>$uploadPath,
        'duration'=>$duration,

    ]);


}