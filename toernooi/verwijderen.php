<?php
session_start();
include "../config.php";
?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>
<div class="container">
    <?php
    if( $_GET["action"] == "delete"):
        $toernooiId = $_GET["id"];
        if($toernooi_object->delete( $toernooiId)):
            header("location:index.php");
        else: ?>
        <div class="alert alert-danger" role="alert">
        Toernooi kan niet verwijderd worden omdat deze nog in gebruik is
        </div>
        <a class="btn btn-primary" href="index.php" role="button">terug naar toernooien</a>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php include PROJECT_PATH ."/incl/footer.php"; ?>
