<?php
session_start();
include "../config.php";
if (isset($_POST["toevoegen"])) {
    $omschrijving= $_POST["omschrijving"];
    $datum = $_POST["datum"];
    $toernooi_object->add($omschrijving, $datum);
    header("location:index.php");
}

?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>

<div class="container mt-2 mb-2">
    <form  method="post">
        <div class="form-group">
            <label for="omschrijving">Omschrijving</label>
            <input type="text" class="form-control" id="omschrijving" aria-describedby="omschrijving" name="omschrijving" placeholder="Enter omschrijving">
        </div>
        <div class="form-group">
            <label for="datum">Datum</label>
            <input type="date" class="form-control" id="datum" aria-describedby="datum" name="datum" placeholder="Enter datum">
        </div>
        <button type="submit" class="btn btn-success" name="toevoegen">Opslaan</button>
        <a class="btn btn-warning" href="index.php">Annuleren</a>
    </form>
</div>


<?php include PROJECT_PATH ."/incl/footer.php"; ?>
