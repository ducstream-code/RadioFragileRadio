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
    <? include '../includes/head.php'?>
    <script src="../js/index.js"></script>

    <title>Music control</title>
</head>

<body>
<div class="container  flex  h-screen pr-16">
    <? include "../includes/sidebar.php"; ?>

    <div class="main left-16">

        <div class="topbar">
            <h3>Music Control</h3>

            <div class="actions">
                <button class="bg-orange-500 rounded p-2" onclick="PlaylistSelection()">Créer une playlist</button>
                <!--onclick="createPlaylist()" -->
            </div>
        </div>

        <div class="wrap playlists">
            <div class="array_wraper">
                <div class="actions">
                    <div class="customers_dropdown">

                    </div>
                </div>

                <div class="customers_table_actions ">
                    <div class="customers_table_left">
                        <h3>Playlists: Prochaines playlists prévues: </h3>
                    </div>
                    <button><ion-icon name="cloud-download-outline"></ion-icon></button>
                </div>

                <table class="orders_table" cellspacing="0" cellpadding="0">
                    <thead>
                    <td class="check-column border_bottom">Edit</td>
                    <td class="check-column border_bottom">Delete</td>
                    <th class="column_title border_bottom">Nom</th>
                    <th class="column-order_date border_bottom">Auteur</th>
                    <th class="column-order_status border_bottom">Durée</th>
                    <th class="column-order_total border_bottom">Prévue</th>

                    </thead>
                    <tbody id="table_body">

                    <?php
                    $stmt = $db->prepare("SELECT * FROM playlist WHERE Time > NOW() ");
                    $stmt->execute();
                    $nextPl = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($nextPl as $key => $nextPlaylist){
                        ?>
                        <tr id="playlist<?=$nextPlaylist['id']?>">
                            <td class="check-column border_bottom"><button class="bg-blue-500 rounded p-2" onclick="editPlaylist(<?=$nextPlaylist['id'] ?>)">Edit</button> </td>
                            <td class="check-column border_bottom"><button class="bg-red-500 rounded p-2" onclick="removePlaylist(<?=$nextPlaylist['id'] ?>)">Delete</button> </td>
                            <td class="column_title border_bottom"><?=$nextPlaylist['name'] ?></td>
                            <td class="column-order_date border_bottom"><?=$nextPlaylist['username'] ?></td>
                            <td class="column-order_status border_bottom"><?= gmdate("H:i:s", $nextPlaylist['duration']);?></td>
                            <td class="column-order_total border_bottom"><?=$nextPlaylist['Time'] ?></td>

                        </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                    <tfoot>
                    <td class="check-column border_bottom">Edit</td>
                    <td class="check-column border_bottom">Delete</td>
                    <th class="column_title border_bottom">Nom</th>
                    <th class="column-order_date border_bottom">Auteur</th>
                    <th class="column-order_status border_bottom">Durée</th>
                    <th class="column-order_total border_bottom">Prévue</th>
                    </tfoot>
                </table>
            </div>
            <div class="array_wraper">
                <div class="actions">
                    <div class="customers_dropdown">

                    </div>
                </div>

                <div class="customers_table_actions">
                    <div class="customers_table_left">
                        <h3>Les createurs de playlists les plus actifs</h3>
                    </div>
                    <button><ion-icon name="cloud-download-outline"></ion-icon></button>
                </div>

                <table class="orders_table" cellspacing="0" cellpadding="0">
                    <thead>
                    <td class="check-column border_bottom">Nom</td>
                    <th class="column_title border_bottom">Nombre de playlist</th>
                    <th class="column-order_date border_bottom">Temps total des playlists</th>
                    <th class="column-order_status border_bottom">Date prochaine playlist</th>

                    </thead>
                    <tbody id="table_body">
                    <tr>
                        <td class="check-column border_bottom">AUrelien</td>
                        <td class="column_title border_bottom">122</td>
                        <td class="column-order_date border_bottom">8:14:25</td>
                        <td class="column-order_status border_bottom">18-02-2022</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <td class="check-column border_bottom">Nom</td>
                    <th class="column_title border_bottom">Nombre de playlist</th>
                    <th class="column-order_date border_bottom">Temps total des playlists</th>
                    <th class="column-order_status border_bottom">Date prochaine playlist</th>
                    </tfoot>
                </table>
            </div>


        </div>
    </div>
</div>

    <form action="../php/createNewPlaylist.php" method="post" id="choosePL" class="waiting_data">
        <h3>Creer une playlist</h3>
        <input name="username" type="text" placeholder="Nom du créateur">
        <input name="name" type="text" placeholder="Nom playlist">
        <input name="date" type="datetime-local">



        <button type="button" class="alert" onclick="ClosePlaylistSelection()">Annuler</button>
        <button class="success" onclick="createPlaylist()">Créer la playlist</button>
    </form>
    <div class="waiting_data_displayed" id="editPl">
        <h3>Editer une playlist</h3>
        <div style="display: flex; flex-wrap: nowrap">
        <input id="changeDate" name="date" type="datetime-local">
        <button id="changeDateButton" onclick="changeDate(idPl)">Changer la date</button>
        </div>
        <div class="music_list" id="PlListEditor">
            <div class="one_music">
                <ion-icon name="close-circle-outline"></ion-icon>
                <h5>Musique</h5>
            </div>
        </div>


        <button class="success" onclick="closePledit()">Fermer</button>
    </div>
    <div id="greybackground" class="greybackground"></div>
</body>
</html>
