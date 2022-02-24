<?php

include "../includes/db.php";
header('Content-type: application/json');

$stmt = $db->prepare("SELECT * FROM playlist");
$stmt->execute();
$res = $stmt->fetchAll();
$array = [];





foreach ($res as $key => $row){
    //get finishing time
    $unixStart = strtotime($row['Time']);
    $duration = $row['duration'];
    $endingUnix = $unixStart + $duration;
    $ending = gmdate("Y-m-d H:i:s", $endingUnix);


    $array[] = [
        'id' => $row['id'],
        'title' => $row['name'],
        'start' => $row['Time'],
        'end'=> $ending,

    ];

}
echo json_encode($array);