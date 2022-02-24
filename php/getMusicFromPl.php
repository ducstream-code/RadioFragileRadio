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
    <div id="music_<?=$music['id_titre'].'+'.$idPl?>" class="one_music mb-4">
        <svg onclick="removeFromPl(<?=$music['id_titre'].','.$idPl?>)" xmlns="http://www.w3.org/2000/svg" class="ionicon bg-red-500 p-1 rounded mr-2 h-8" viewBox="0 0 512 512"><title>Trash</title><path d="M112 112l20 320c.95 18.49 14.4 32 32 32h184c17.67 0 30.87-13.51 32-32l20-320" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 112h352"/><path d="M192 112V72h0a23.93 23.93 0 0124-24h80a23.93 23.93 0 0124 24h0v40M256 176v224M184 176l8 224M328 176l-8 224" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>

        <h5><?=$res2['title']?></h5>
    </div>

    <?php
}
