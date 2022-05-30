<?php
session_start();
include "../config.php";
?>

<?php include PROJECT_PATH ."/incl/header.php"; ?>
<div class="container mt-2">
    <?php $spelers = $speler_object->get(); ?>
    <h1>Spelers</h1>
    <div class="row mt-2 mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel(s)</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>School</th>
                    <input type="text" placeholder="Search..">
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($spelers as $speler): ?>
                <tr>
                    <td><?php echo $speler["roepnaam"];  ?></td>
                    <td><?php echo $speler["tussenvoegsels"];  ?></td>
                    <td><?php echo $speler["achternaam"];  ?></td>
                    <td><?php echo $speler["schoolnaam"];  ?></td>
                    <td><a href="bewerken.php?id=<?php echo $speler["spelerId"]?>&action=edit"><i class="fas fa-edit"></i></a></td>
                    <td><a href="verwijderen.php?id=<?php echo $speler["spelerId"]?>&action=delete"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="row mt-2 mb-2">
        <a href="toevoegen.php" class="btn btn-info btn-lg">&plus;</a>
    </div>
</div>
<?php include PROJECT_PATH ."/incl/footer.php"; ?>
