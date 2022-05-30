<?php
session_start();
include "../config.php";
if (isset($_POST["toevoegen"])) {
    $schoolnaam = $_POST["schoolnaam"];
    $school_object->addSchool($schoolnaam);

    header("location:index.php");
}

?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>
<div class="container mt-3">
    <form method="post">
        <div class="form-group">
            <label for="schoolnaam">Schoolnaam</label>
            <input type="text" class="form-control" id="schoolnaam" aria-describedby="schoolnaam" name="schoolnaam" placeholder="Enter schoolnaam">
        </div>
        <button type="submit" class="btn btn-success" name="toevoegen">Opslaan</button>
        <a class="btn btn-warning" href="index.php">Annuleren</a>
    </form>
</div>


<?php include PROJECT_PATH ."/incl/footer.php"; ?>
