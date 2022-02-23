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
    <? include '../includes/head.php'?>
    <script src="../js/accounts.js"></script>



    <title>Comptes</title>
</head>
<?= checkLoggedUser() ? '' : header('Location: ../index.php') ?>

<body>

<div class="container flex  h-screen pr-16">
    <? include "../includes/sidebar.php";
    if($user['role'] == 0){
        header('Location: ../index.php');
    }
    ?>

    <div class="main left-16">
        <div class="topbar">
            <h3>Clients</h3>
            <div class="actions">

            </div>
        </div>
        <div class="wrap">
            <div class="customers_dropdown account_actions">

                <form action="../php/createAccount.php" method="post" class="customers_select creation create_account">
                    <input class="rounded p-1 border-solid border-2 border-indigo-600" type="text" name="username" placeholder="Username">
                    <input class="rounded p-1 border-solid border-2 border-indigo-600" type="password" name="password" placeholder="Mot de passe">
                    <button class="bg-green-500 rounded p-2">Créer le compte</button>

                </form>
            </div>

            <div class="customers_table_actions">
                <div class="customers_table_left">
                    <h3>Comptes</h3>
                    <input type="text">
                </div>
                <button ><ion-icon name="cloud-download-outline"></ion-icon></button>
            </div>
            <table class="orders_table customers_table" cellspacing="0" cellpadding="0">
                <thead>
                <th>id</th>
                <th>Username</th>
                <th>Admin ?</th>
                <th>role</th>
                <th>Action</th>
                </thead>
                <tbody id="table_body">
                <?php
                    $stmt = $db->prepare("SELECT * FROM users");
                    $stmt->execute();
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($res as $key => $account){
                        ?>
                        <tr id="acc_<?=$account['id']?>">
                            <td><?=$account['id']?></td>
                            <td><?=$account['username']?></td>
                            <td><?= $user['role'] == 0 ? 'admin' : 'pas admin' ?></td>
                            <td ><?=$account['role']?></td>
                            <td><button class="bg-red-500 rounded p-2" onclick="deleteAccount(<?=$account['id']?>)">Supprimer</button></td>

                        </tr>
                <?php
                    }
                ?>


                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>
