<?php

include "../includes/db.php";
$idPl = $_GET['idPl'];

$date = str_replace("T"," ",$_GET['date']);
$date = strtotime($date);

$stmt = $db->prepare("UPDATE playlist SET Time = :date WHERE id = :idPl ");
$stmt->execute([
    'date' => gmdate("Y-m-d H:i:s",$date),
    'idPl' => $idPl,
]);
