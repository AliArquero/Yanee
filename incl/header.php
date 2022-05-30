<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>MBO Open</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>/css/style.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php"><i class="fas fa-table-tennis"></i> MBO Open </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="basisDrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-database"></i> Basisgegevens
                    </a>
                    <div class="dropdown-menu" aria-labelledby="basisDrop">
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>speler/index.php">Spelers</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>school/index.php">Scholen</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>toernooi/index.php">Toernooien</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="toernooiDrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fab fa-steam"></i> Toernooien
                    </a>
                    <div class="dropdown-menu" aria-labelledby="toernooiDrop">
                        <?php $toernooien = $toernooi_object->get();?>
                        <?php foreach($toernooien as $toernooi):?>
                            <a class="dropdown-item" href="<?php echo BASE_URL . "toernooi/beheer.php?id=" . $toernooi["id"] ?>"><?php echo $toernooi["omschrijving"]; ?></a>
                        <?php endforeach;?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
