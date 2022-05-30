<?php
session_start();
include "../config.php";
if (isset($_POST["toevoegen"])) {
    $roepnaam= $_POST["roepnaam"];
    $tussenvoegsels = $_POST["tussenvoegsels"];
    $achternaam = $_POST["achternaam"];
    $schoolId = $_POST["school"];
    $speler_object->add($roepnaam, $tussenvoegsels, $achternaam, $schoolId);

    header("location:index.php");
}

?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="roepnaam">Roepnaam</label>
            <input type="text" class="form-control" id="roepnaam" aria-describedby="roepnaam" name="roepnaam" placeholder="Enter roepnaam">
        </div>
        <div class="form-group">
            <label for="tussenvoegsels">Tussenvoegsels</label>
            <input type="text" class="form-control" id="tussenvoegsels" aria-describedby="tussenvoegsels" name="tussenvoegsels" placeholder="Enter tussenvoegsel">
        </div>
        <div class="form-group">
            <label for="achternaam">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" aria-describedby="achternaam" name="achternaam" placeholder="Enter achternaam">
        </div>
        <div class="form-group">
            <?php  $scholen = $school_object->getSchoolOption(); ?>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Scholen</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" name="school">
                <option value="">select school</option>
                <?php   foreach($scholen as $school): ?>
                <option value="<?php echo $school["id"] ?>"><?php echo $school["naam"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success" name="toevoegen">Opslaan</button>
        <a class="btn btn-warning" href="index.php">Annuleren</a>
    </form>
</div>


<?php include PROJECT_PATH ."/incl/footer.php"; ?>
