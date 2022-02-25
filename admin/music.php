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

<body id="body" onload="fetchMusic()">
<div class="w-full background -translate-x-full p-8 bg-gray-300 fixed top-0 z-50 " id="calendar"></div>

<div id="greybackground" class="greybackground"></div>

<div class="container flex  h-screen pr-16">
    <? include "../includes/sidebar.php"; ?>

    <div class="main left-16">

        <div class="topbar">
            <h3>Music list</h3>
            <div class="actions flex flex-row-reverse">
            <button id="showNext" class="bg-green-500 rounded p-2" onclick="showSlideOver();getMusicInList()">Next</button>
                <!--onclick="createPlaylist()" -->
            </div>
        </div>

        <div class="wrap">
            <div class="actions">
                <div class="customers_dropdown">
                    <!--
                    <select class="customers_select">
                        <option value="-1">Toutes les musiques</option>
                    </select> -->
                </div>
            </div>

            <div class="customers_table_actions rounded-t-2xl">
                <div class="customers_table_left rounded">
                    <h3>Musics</h3>
                    <input onkeyup="searchMusic(this.value)" id="musicSearch" class="border-solid border-2 border-indigo-600 rounded" placeholder="Search for music in the database" type="text">
                </div>
                <button class="hidden"><ion-icon name="cloud-download-outline"></ion-icon></button>
            </div>
            <div class="absolute ml-32 rounded bg-gray-300 rounded" id="searchResults">

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
<!-- This example requires Tailwind CSS v2.0+ -->
<div id="slidershowcontainer" class="fixed inset-0 overflow-hidden hidden " aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div id="" class="absolute inset-0 overflow-hidden ">
        <!--
          Background overlay, show/hide based on slide-over state.

          Entering: "ease-in-out duration-500"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in-out duration-500"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity " aria-hidden="true"></div>
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <!--
              Slide-over panel, show/hide based on slide-over state.

              Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                From: "translate-x-full"
                To: "translate-x-0"
              Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                From: "translate-x-0"
                To: "translate-x-full"
            -->
            <div id="sliderMain" class=" pointer-events-auto relative w-screen max-w-md transform transition ease-in-out duration-500 sm:duration-700">
                <!--
                  Close button, show/hide based on slide-over state.

                  Entering: "ease-in-out duration-500"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in-out duration-500"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                    <button  type="button" class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="sr-only">Close panel</span>
                        <!-- Heroicon name: outline/x -->
                        <svg onclick="hideSlideOver()" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                    <div class="px-4 sm:px-6 flex space-x-4 fixed z-50 bg-white w-full">
                        <h2 class="text-lg font-medium text-gray-900  " id="slide-over-title">Add Musics</h2><button class="p-1 rounded bg-blue-400 mr-4" onclick="createPlaylist()">Create</button><button class="p-1 rounded bg-gray-300 mr-4" onclick="showPlanning()">Show Planning</button>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <!-- Replace with your content -->
                        <div class="absolute inset-0 px-4 sm:px-6 mt-8">
                            <h3 class="text-center text-2xl">Create Playlist</h3>
                            <select id="PLselect" class="bg-green-400 mt-4 rounded p-2">
                                <option value="">--Please choose a playlist--</option>
                                <?php
                                if($user['role'] !=0){
                                    $stmt = $db->prepare("SELECT name, id FROM playlist WHERE Time IS NULL");
                                    $stmt->execute();
                                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $key => $playlist){
                                        ?>
                                        <option value="<?=$playlist['id']?>"><?=$playlist['name']?></option>
                                        <?php
                                    }
                                }else{
                                    $stmt = $db->prepare("SELECT name, id FROM playlist WHERE username = :user AND Time IS NULL");
                                    $stmt->execute(['user'=>$user['username']]);
                                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $key => $playlist){
                                        ?>
                                        <option value="<?=$playlist['id']?>"><?=$playlist['name']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <input class="w-full text-2xl mt-8 rounded border-2 border-solid border-gray-500" id="changeDate" name="date" type="datetime-local">
                            <div id="createPlResponse" class="text-red-600 text-2xl text-center"></div>
                            <div id="musicList" class="border-2 border-dashed border-gray-200 p-4 mt-10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>

    </script>
</body>
</html>
