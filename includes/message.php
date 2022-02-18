<?php

/* Permet d'afficher les différentes alertes */
if (isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type']) && !empty($_GET['type'])) {


?>

<div class="alert_container" onclick="this.remove()">
    <div class="alert alert-<?=$_GET['type'] ?>" role="alert">
        <p><?= htmlspecialchars($_GET['message']) ?></p>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $_GET['type'] ?></h5>
            </div>
            <div class="modal-body">
                <p><?= htmlspecialchars($_GET['message']) ?></p>
            </div>
            <div class="modal-footer">
            <?php if($_GET['type'] == 'Succès inscription') echo '<button onclick="window.location=\'/pages/login.php\'" type="button" class="btn btn-primary">Se connecter</button>'?>
                <button onclick="let modal = document.getElementsByClassName('modal'); modal[0].remove()" type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
<?php
}
?>



