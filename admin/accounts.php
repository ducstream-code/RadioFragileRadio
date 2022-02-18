<?php
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php'
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="icon" type="image/png" href=""/>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../js/accounts.js"></script>



    <title>Comptes</title>
</head>

<body>

<div class="container">

    <div class="main">
        <div class="topbar">
            <h3>Clients</h3>
        </div>
        <div class="wrap">
            <div class="customers_dropdown account_actions">

                <form action="../php/createAccount.php" method="post" class="customers_select creation create_account">
                    <input type="text" name="username" placeholder="Username">
                    <input type="text" name="password" placeholder="Mot de passe">
                    <button>Créer le compte</button>
                    <h2 style="color: <?=$_GET['type']?>"><?=$_GET['message']?></h2>

                </form>
            </div>

            <div class="customers_table_actions">
                <div class="customers_table_left">
                    <h3>Comptes</h3>
                    <input type="text">
                </div>
                <button><ion-icon name="cloud-download-outline"></ion-icon></button>
            </div>
            <table class="orders_table customers_table" cellspacing="0" cellpadding="0">
                <thead>
                <th>id</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
                </thead>
                <tbody id="table_body">
                <?php
                    $stmt = $db->prepare("SELECT * FROM music_users");
                    $stmt->execute();
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($res as $key => $account){
                        ?>
                        <tr id="acc_<?=$account['id']?>">
                            <td><?=$account['id']?></td>
                            <td><?=$account['username']?></td>
                            <td><?=$account['password']?></td>
                            <td><button onclick="deleteAccount(<?=$account['id']?>)">Supprimer</button></td>

                        </tr>
                <?php
                    }
                ?>


                </tbody>

        </div>
    </div>
</div>
</body>

</html>
