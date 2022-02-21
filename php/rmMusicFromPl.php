<?php
include '../includes/db.php';

$id = $_GET['id'];
$idPL = $_GET['idPl'];

$stmt = $db->prepare("DELETE FROM played_title WHERE id_titre = :idTitre AND id_playlist = :idpl");
$stmt->execute(['idTitre'=>$id,'idpl'=>$idPL]);

