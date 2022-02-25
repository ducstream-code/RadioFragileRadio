<?php

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