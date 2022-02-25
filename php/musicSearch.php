<?php
include "../includes/db.php";
// DISPLAY ERRORS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$search = $_GET['search'];

$stmt = $db->prepare("SELECT id,title,artist,album FROM musics WHERE title LIKE '%" . $search . '%\' LIMIT 6');
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<table class="bg-white rounded">
<thead>
<td class="border-l-2 border-gray-300 border-solid p-2 bg-gray-500">checkbox</td>
<td class="border-l-2 border-gray-300 border-solid p-2 bg-gray-500">titre</td>
<td class="border-l-2 border-gray-300 border-solid p-2 bg-gray-500">artiste</td>
<td class="border-l-2 border-gray-300 border-solid p-2 bg-gray-500">album</td>
</thead>

';


foreach ($res as $key => $result){
    ?>
    <tr class="border-solid border-2 border-gray-300">
        <td class="border-l-2 border-gray-300 border-solid p-2"><input id="<?=$result['id']?>" value="<?=$result['id']?>" onchange="getIdMusic(<?=$result['id']?>)" type="checkbox"></td>
        <td class="border-l-2 border-gray-300 border-solid p-2"><?=$result['title']?></td>
        <td class="border-l-2 border-gray-300 border-solid p-2"><?=$result['artist']?></td>
        <td class="border-l-2 border-gray-300 border-solid p-2"><?=$result['album']?></td>
    </tr>
<?php
}
echo '</table>';