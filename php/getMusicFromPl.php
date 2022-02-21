<?php
include '../includes/db.php';
$idPl = $_GET['id'];

$stmt = $db->prepare("SELECT id_titre FROM played_title WHERE id_playlist = $idPl ");
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($res as $music){
    $stmt = $db->prepare("SELECT title FROM musics WHERE id = :id ");
    $stmt->execute(['id'=>$music['id_titre']]);
    $res2 = $stmt->fetch();

    ?>
    <div id="music_<?=$music['id_titre'].'+'.$idPl?>" class="one_music">
        <ion-icon onclick="removeFromPl(<?=$music['id_titre'].','.$idPl?>)" name="close-circle-outline"></ion-icon>
        <h5><?=$res2['title']?></h5>
    </div>

    <?php
}
