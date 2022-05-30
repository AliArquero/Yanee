<?php

//haal status toernooi op
$status = $toernooi_object->getStatus($_SESSION["toernooiId"]);
$import = "";
if (isset($_POST["importeren"]) && $status == 0) {
   if($aanmelding_object->importeer($_POST["bestandsnaam"], $_SESSION["toernooiId"])){
       $import = "gelukt";
   };
}
?>
<div class="container">

    <?php if($status == 0):?>
    <form method="post">
        <div class="form-group">
            <label for="bestandsnaam">Bestandsnaam</label>
            <input type="file" class="form-control" id="bestandsnaam" aria-describedby="bestandsnaam" name="bestandsnaam" placeholder="Enter bestandsnaam" value="">
        </div>

        <button type="submit" class="btn btn-success" name="importeren">Importeren</button>
        <!-- <a class="btn btn-warning" href="index.php">Annuleren</a> -->
    </form>
        <?php if($import =="gelukt"): ?>
        <div class="alert alert-success mt-2" role="alert">
            Het importeren is gelukt!
        </div>
        <?php endif?>

    <?php else: ?>
    <div class="alert alert-warning mt-2" role="alert">
        Het toernooi is al gesloten. Er kunnen geen nieuwe deelnemers toegevoegd worden.
    </div>
    <?php endif; ?>
</div>
