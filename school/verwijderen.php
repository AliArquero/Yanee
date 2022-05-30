

<?php
session_start();
include "../config.php";
?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>
<div class="container">
    <?php
    if( $_GET["action"] == "delete"):
        $schoolId = $_GET["id"];
        if($school_object->deleteSchool( $schoolId)):
            header("location:index.php");
        else: ?>
        <div class="alert alert-danger" role="alert">
        SCHOOL kan niet verwijderd worden omdat deze nog in gebruik is
        </div>
        <a class="btn btn-primary" href="index.php" role="button">terug naar spelers</a>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php include PROJECT_PATH ."/incl/footer.php"; ?>
