<?php
include '../includes/db.php';
$id = $_GET['id'];

$stmt = $db->prepare("DELETE FROM music_users WHERE id = :id");
$stmt->execute(['id'=>$id]);
echo 'Successfully deleted';
