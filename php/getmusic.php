<?php
include '../includes/db.php';
$limit = $_GET['limit'];

$stmt = $db->prepare("SELECT * FROM musics LIMIT $limit ");
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($res as $music){
    ?>

    <tr>
        <td class="check-column border_bottom"><input id="<?=$music['id']?>" value="<?=$music['id']?>" onchange="getIdMusic(<?=$music['id']?>)" type="checkbox"></td>
        <td class="column_title border_bottom"><?=$music['title']?> </td>
        <td class="column-order_date border_bottom"><?=$music['artist']?></td>
        <td class="column-order_status border_bottom"><?=$music['album']?></td>
        <td class="column-order_total border_bottom"><?=$music['genre']?></td>
        <td class="column-order_total border_bottom"><?=$music['date']?></td>
        <td class="column-order_total border_bottom"><?= gmdate("i:s", $music['duration']);$music['duration']?></td>
    </tr>
<?php
}
