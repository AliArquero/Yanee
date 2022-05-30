<?php
session_start();
require_once("../config.php");
?>
<?php include PROJECT_PATH. "/incl/header.php"; ?>
<div class="container mt-2">
    <?php $toernooien = $toernooi_object->get(); ?>

    <h1>Toernooien</h1>
    <div class="row mt-2 mb-2">  
        <table class="table">
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>datum</th>
                    <th>status</th>
                    <th>Aantal Deelnemers</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($toernooien as $toernooi): ?>
                <tr>
                    <td><?php echo $toernooi["omschrijving"];  ?></td>
                    <td><?php echo $toernooi["datum"];  ?></td>
                    <td><?php echo ($toernooi["status"] == 0) ? "<span class='text-success'>open</span>" : "<span class='text-danger'>gesloten</span>"   ?></td>
                    <td><?php echo count($aanmelding_object->get($toernooi["id"]));?></td>
                    <td><a href="bewerken.php?id=<?php echo $toernooi["id"]?>&action=edit" class="text-warning"><i class="fas fa-edit"></i></a></td>
                    <td><a href="verwijderen.php?id=<?php echo $toernooi["id"]?>&action=delete" class="text-danger" ><i class="fas fa-trash-alt"></i></a></td>
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
