<?php
session_start();
include "../config.php";
if( $_GET["action"] == "edit"){
    $toernooiId = $_GET["id"];
    $toernooi = $toernooi_object->get($toernooiId);
}
$message = "";
$disabled ="";
if ($toernooi["status"] == 0) {
    if (isset($_POST["bewerken"])) {
        $omschrijving = $_POST["omschrijving"];
        $datum = $_POST["datum"];
        $toernooi_object->update($toernooiId, $omschrijving, $datum);
        header("location:index.php");
    }

}else{
    $disabled = "disabled";
    $message = '<div class="alert alert-danger" role="alert">Dit toernooi is al gesloten en kan niet meer gewijzigd worden</div>';
}

?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>

<div class="container mt-2 mb-2">
    <?php echo $message;?>
    <form  method="post">
        <div class="form-group">
            <label for="omschrijving">Omschrijving</label>
            <input type="text" class="form-control" id="omschrijving" aria-describedby="omschrijving" name="omschrijving" placeholder="Enter omschrijving" value="<?php echo $toernooi["omschrijving"] ?>" <?php echo $disabled;?>>
        </div>
        <div class="form-group">
            <label for="datum">Datum</label>
            <input type="date" class="form-control" id="datum" aria-describedby="datum" name="datum" placeholder="Enter datum" value="<?php echo $toernooi["datum"] ?>" <?php echo $disabled;?>>
        </div>
        <button type="submit" class="btn btn-success" name="bewerken">Opslaan</button>
        <a class="btn btn-warning" href="index.php">Annuleren</a>
    </form>
</div>

<?php include PROJECT_PATH ."/incl/footer.php"; ?>
