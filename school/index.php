<?php
session_start();
include "../config.php";
?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>
<div class="container mt-2">
    <?php $scholen = $school_object->get();; ?>
    <h1>Scholen</h1>
    <div class="row mt-2 mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Schoolnaam</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($scholen as $school): ?>
                <tr>
                    <td><?php echo $school["naam"];  ?></td>
                    <td><a href="bewerken.php?id=<?php echo $school["id"]?>&action=edit"><i class="fas fa-edit"></i></a></td>
                    <td><a href="verwijderen.php?id=<?php echo $school["id"]?>&action=delete"><i class="fas fa-trash-alt"></i></a></td>
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
