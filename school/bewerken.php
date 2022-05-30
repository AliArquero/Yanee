<?php
session_start();
include "../config.php";
if( $_GET["action"] == "edit"){
    $schoolId = $_GET["id"];
    $school = $school_object->get($schoolId);
}

if (isset($_POST["bewerken"])) {
    $schoolnaam = $_POST["schoolnaam"];
    $school_object->updateSchool($schoolId, $schoolnaam);

    header("location:index.php");
}

?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>
<div class="container mt-3">
    <form method="post">
        <div class="form-group">
            <label for="schoolnaam">Schoolnaam</label>
            <input type="text" class="form-control" id="schoolnaam" aria-describedby="schoolnaam" name="schoolnaam" value="<?php echo $school["naam"]?>" placeholder="Enter schoolnaam">
        </div>
        <button type="submit" class="btn btn-success" name="bewerken">Opslaan</button>
        <a class="btn btn-warning" href="index.php">Annuleren</a>
    </form>
</div>


<?php include PROJECT_PATH ."/incl/footer.php"; ?>
