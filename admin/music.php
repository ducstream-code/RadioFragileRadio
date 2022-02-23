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
    <script src="../js/music.js"></script>
    <title>Musiques</title>
</head>
<?= checkLoggedUser() ? '' : header('Location: ../index.php') ?>

<body onload="fetchMusic()">
<div id="greybackground" class="greybackground"></div>
<div class="container flex  h-screen pr-16">
    <? include "../includes/sidebar.php"; ?>

    <div class="main left-16">

        <div class="topbar">
            <h3>Music list</h3>
            <div id="test"></div>
            <div class="actions">
            <button class="bg-green-500 rounded p-2" onclick="PlaylistSelection()" >Add to a playlist</button>
                <button class="bg-blue-500 rounded p-2">See music in the playlist</button>
                <!--onclick="createPlaylist()" -->
            </div>
        </div>

        <div class="wrap">
            <div class="actions">
                <div class="customers_dropdown">
                    <select class="customers_select">
                        <option value="-1">Toutes les musiques</option>
                    </select>
                </div>
            </div>

            <div class="customers_table_actions">
                <div class="customers_table_left">
                    <h3>Musics</h3>
                    <input class="border-solid border-2 border-indigo-600 rounded" type="text">
                </div>
                <button><ion-icon name="cloud-download-outline"></ion-icon></button>
            </div>

            <table class="orders_table" cellspacing="0" cellpadding="0">
                <thead>
                    <td class="check-column border_bottom"><input type="checkbox"></td>
                    <th class="column_title border_bottom">Titre</th>
                    <th class="column-order_date border_bottom">Artiste</th>
                    <th class="column-order_status border_bottom">Album</th>
                    <th class="column-order_total border_bottom">Genre</th>
                    <th class="column-order_total border_bottom">Année</th>
                    <th class="column-order_total border_bottom">durée</th>
                </thead>
                <tbody id="table_body">
                    <tr>
                        <td class="check-column border_bottom"><input type="checkbox"></td>
                        <td class="column_title border_bottom">Lose Yourself </td>
                        <td class="column-order_date border_bottom">Eminem</td>
                        <td class="column-order_status border_bottom">Curtain Call: The Hits</td>
                        <td class="column-order_total border_bottom">Rap/Hip Hop</td>
                        <td class="column-order_total border_bottom">2005</td>
                        <td class="column-order_total border_bottom">327</td>
                    </tr>
                </tbody>
                <tfoot>
                    <td class="check-column border_bottom"><input type="checkbox"></td>
                    <th class="column_title border_bottom">Titre</th>
                    <th class="column-order_date border_bottom">Artiste</th>
                    <th class="column-order_status border_bottom">Album</th>
                    <th class="column-order_total border_bottom">Genre</th>
                    <th class="column-order_total border_bottom">Année</th>
                    <th class="column-order_total border_bottom">durée</th>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="choosePL" class="waiting_data">
    <h3>Create Playlist</h3>

    <select id="PLselect">
        <option value="">--Please choose a playlist--</option>
        <?php
        if($user['role'] !=0){
            $stmt = $db->prepare("SELECT name, id FROM playlist");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $key => $playlist){
                ?>
                <option value="<?=$playlist['id']?>"><?=$playlist['name']?></option>
        <?php
            }
        }else{
            $stmt = $db->prepare("SELECT name, id FROM playlist WHERE id = :id");
            $stmt->execute(['id'=>$user['id']]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $key => $playlist){
                ?>
                <option value="<?=$playlist['id']?>"><?=$playlist['name']?></option>
                <?php
            }
        }
        ?>

    </select>

    <button class="alert" onclick="ClosePlaylistSelection()">Add more musics</button>
    <button class="success" onclick="createPlaylist()">Add title to the playlist</button>
</div>




</body>
</html>
