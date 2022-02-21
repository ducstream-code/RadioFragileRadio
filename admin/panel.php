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
    <script src="../js/panel.js"></script>
    <title>Mon panel</title>
</head>

<body>
<div class="container flex  h-screen pr-16">
    <? include "../includes/sidebar.php"; ?>

    <div class="main left-16">
        <div class="topbar">
            <h3>Mon Panel</h3>
            <div class="actions">
                <button class="bg-orange-500 rounded p-2" onclick="PlaylistSelection()">Créer une playlist</button>

            </div>
        </div>
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">Date</div>
                    <div class="cardName">My next playlist</div>
                </div>
                <div class="iconBx"><ion-icon name="eye-outline"></ion-icon></div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">3</div>
                    <div class="cardName">Mon nombre de playlist</div>
                </div>
                <div class="iconBx"><ion-icon name="cart-outline"></ion-icon></ion-icon></ion-icon></div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">Créer</div>
                    <div class="cardName">Créer une nouvelle playlist</div>
                </div>
                <div class="iconBx"><ion-icon name="person-add-outline"></ion-icon></ion-icon></div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">Show</div>
                    <div class="cardName">Afficher la programmation</div>
                </div>
                <div class="iconBx"><ion-icon name="cash-outline"></ion-icon></ion-icon></div>
            </div>
        </div>
        <div class="wrap">
            <div class="customers_table_actions">
                <div class="customers_table_left">
                    <h3>My playlists</h3>
                </div>
            </div>
            <table class="orders_table customers_table " cellspacing="0" cellpadding="0">
                <thead>
                <th>nom</th>
                <th>durée</th>
                <th>date</th>
                <th>action</th>
                <th>action 2 </th>

                </thead>
                <tbody id="table_body">
                <?php
                $stmt = $db->prepare("SELECT * FROM playlist WHERE username = :username");
                $stmt->execute([
                        'username'=>'test'
                ]);
                $nextPl = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($nextPl as $key => $nextPlaylist){
                ?>
                <tr id="playlist<?=$nextPlaylist['id']?>">
                    <td class=" border_bottom"><?=$nextPlaylist['name'] ?></td>
                    <td class=" border_bottom"><?= gmdate("H:i:s", $nextPlaylist['duration']);?></td>
                    <td class=" border_bottom"><?=$nextPlaylist['Time'] ?></td>
                    <td class=" border_bottom"><button class="bg-blue-500 rounded p-2" onclick="editPlaylist(<?=$nextPlaylist['id'] ?>)">Edit</button> </td>
                    <td class="border_bottom" ><button class="bg-red-500 rounded p-2 " onclick="removePlaylist(<?=$nextPlaylist['id'] ?>)">Supprimer</button> </td>

                </tr>
                <?php
                    }
                    ?>


                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="waiting_data_displayed" id="editPl">
    <h3>Creer une playlist</h3>
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

<form action="../php/createNewPlaylist.php" method="post" id="choosePL" class="waiting_data">
    <h3>Creer une playlist</h3>
    <input name="username" type="text" placeholder="Nom du créateur">
    <input name="name" type="text" placeholder="Nom playlist">
    <input name="date" type="datetime-local">



    <button type="button" class="alert" onclick="ClosePlaylistSelection()">Annuler</button>
    <button class="success" onclick="createPlaylist()">Créer la playlist</button>
</form>
<div id="greybackground" class="greybackground"></div>
</body>

</html>
