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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src=".."></script>
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="icon" type="image/png" href=""/>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



    <title>Music control</title>
</head>

<body>
    <div class="main">

        <div class="topbar">
            <h3>Music Control</h3>
            <div id="test"></div>
            <div class="actions">
                <button onclick="PlaylistSelection()" >Gestion des playlists</button>
                <button>Gérer les comptes</button>
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
                    <th class="column_title border_bottom">Nom</th>
                    <th class="column-order_date border_bottom">Auteur</th>
                    <th class="column-order_status border_bottom">Durée</th>
                    <th class="column-order_total border_bottom">Prévue</th>

                    </thead>
                    <tbody id="table_body">
                    <tr>
                        <td class="check-column border_bottom"><button>Edit</button> </td>
                        <td class="column_title border_bottom">Lo-Fi</td>
                        <td class="column-order_date border_bottom">Aurélien</td>
                        <td class="column-order_status border_bottom">55:26</td>
                        <td class="column-order_total border_bottom">13-12-2022 à 21h45</td>

                    </tr>


                    <tr>
                        <td class="check-column border_bottom"><button>Edit</button> </td>
                        <td class="column_title border_bottom">Lo-Fi</td>
                        <td class="column-order_date border_bottom">Aurélien</td>
                        <td class="column-order_status border_bottom">55:26</td>
                        <td class="column-order_total border_bottom">13-12-2022 à 21h45</td>

                    </tr>
                    <tr>
                        <td class="check-column border_bottom"><button>Edit</button> </td>
                        <td class="column_title border_bottom">Lo-Fi</td>
                        <td class="column-order_date border_bottom">Aurélien</td>
                        <td class="column-order_status border_bottom">55:26</td>
                        <td class="column-order_total border_bottom">13-12-2022 à 21h45</td>

                    </tr>
                    <tr>
                        <td class="check-column border_bottom"><button>Edit</button> </td>
                        <td class="column_title border_bottom">Lo-Fi</td>
                        <td class="column-order_date border_bottom">Aurélien</td>
                        <td class="column-order_status border_bottom">55:26</td>
                        <td class="column-order_total border_bottom">13-12-2022 à 21h45</td>

                    </tr>
                    <tr>
                        <td class="check-column border_bottom"><button>Edit</button> </td>
                        <td class="column_title border_bottom">Lo-Fi</td>
                        <td class="column-order_date border_bottom">Aurélien</td>
                        <td class="column-order_status border_bottom">55:26</td>
                        <td class="column-order_total border_bottom">13-12-2022 à 21h45</td>

                    </tr>
                    <tr>
                        <td class="check-column border_bottom"><button>Edit</button> </td>
                        <td class="column_title border_bottom">Lo-Fi</td>
                        <td class="column-order_date border_bottom">Aurélien</td>
                        <td class="column-order_status border_bottom">55:26</td>
                        <td class="column-order_total border_bottom">13-12-2022 à 21h45</td>

                    </tr>
                    </tbody>
                    <tfoot>
                    <td class="check-column border_bottom">Edit</td>
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
                    <tr>
                        <td class="check-column border_bottom">AUrelien</td>
                        <td class="column_title border_bottom">122</td>
                        <td class="column-order_date border_bottom">8:14:25</td>
                        <td class="column-order_status border_bottom">18-02-2022</td>
                    </tr>
                    <tr>
                        <td class="check-column border_bottom">AUrelien</td>
                        <td class="column_title border_bottom">122</td>
                        <td class="column-order_date border_bottom">8:14:25</td>
                        <td class="column-order_status border_bottom">18-02-2022</td>
                    </tr>
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
</body>
</html>
