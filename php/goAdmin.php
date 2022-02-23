<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

$method = $_GET['method'];
$id = $_GET['id'];


if($method == 0) {
    //goAdmin
$admin = 1;
    $stmt = $db->prepare("UPDATE users set role= :role WHERE id = :id");
    $stmt->bindParam(':role',$admin);
    $stmt->bindParam(':id',$id);
    $stmt->execute();

}elseif($method ==1){
    $admin = 0;
    $stmt = $db->prepare("UPDATE users set role= :role WHERE id = :id");
    $stmt->bindParam(':role',$admin);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
}