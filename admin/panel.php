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



    <title>Musiques</title>
</head>

<body onload="fetchMusic()">

<div class="container">

    <div class="main">

        <div class="topbar">
            <h3>Music list</h3>
            <div id="test"></div>
            <div class="actions">
            <button onclick="PlaylistSelection()" >Add to a playlist</button>
                <button>See music in the playlist</button>
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
                    <input type="text">
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
                    <th class="column-order_total border_bottom">duration</th>
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
                    <th class="column-order_total border_bottom">duration</th>
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
            $stmt = $db->prepare("SELECT nom, id FROM playlist");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $key => $playlist){
                ?>
                <option value="<?=$playlist['id']?>"><?=$playlist['nom']?></option>
        <?php
            }
        ?>

    </select>

    <button class="alert" onclick="ClosePlaylistSelection()">Add more musics</button>
    <button class="success" onclick="createPlaylist()">Add title to the playlist</button>
</div>

<div id="greybackground" class="greybackground"></div>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="../js/panel.js"></script>

</body>
</html>
