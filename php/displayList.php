<?php

include "../includes/db.php";

$list = $_GET['list'];

$decodelist = json_decode($list);

if($decodelist){
foreach ($decodelist as $music) {
$intmusic = intval($music);
    $stmt = $db->prepare("SELECT title FROM musics WHERE id = :id");
    $stmt->bindParam(':id',$intmusic);
    $stmt->execute();
    $title = $stmt->fetch();
    ?>
    <div id="list_<?=$intmusic?>" class="h-8 flex mb-6 ">
        <svg onclick="removeMusicFromList(<?=$intmusic?>)" class="ionicon bg-red-500 p-1 rounded mr-2" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><title>Trash</title><path d="M112 112l20 320c.95 18.49 14.4 32 32 32h184c17.67 0 30.87-13.51 32-32l20-320" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 112h352"/><path d="M192 112V72h0a23.93 23.93 0 0124-24h80a23.93 23.93 0 0124 24h0v40M256 176v224M184 176l8 224M328 176l-8 224" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
        <div class=""><h4><?=$title['title'] ?></h4></div>
    </div>
<?php
}
}else{
    echo 'Empty list';
}