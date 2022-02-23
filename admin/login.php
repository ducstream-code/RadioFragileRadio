<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';
include('../includes/check_session.php');

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="../js/music.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/png" href=""/>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <title>Log In</title>
</head>

<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="../php/login.php" method="post">
    <h3>S'inscrire</h3>

    <label for="username">Username</label>
    <input name="username" type="text" placeholder="Username" id="username">


    <label for="password">Password</label>
    <input name="password" type="password" placeholder="Password" id="password">

    <button>S'inscrire</button>
</form>
<?php include('../includes/message.php');?>
</body>
</html>