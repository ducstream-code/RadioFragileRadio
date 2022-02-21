<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

$idPl = $_GET['idPl'];

$stmt = $db->prepare("DELETE FROM playlist WHERE id = :idPl");
$stmt->execute(['idPl'=>$idPl]);
echo 'Successfully deleted';
