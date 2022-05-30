<?php
session_start();
include "../config.php";

if(isset($_GET["id"]) ){
    $_SESSION["toernooiId"]  = $_GET["id"];
}
$toernooi = $toernooi_object->get($_SESSION["toernooiId"]);

?>
<?php include PROJECT_PATH ."/incl/header.php"; ?>

<div class="container mt-2">

        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <a class="navbar-brand" href="#"><?php echo $toernooi["omschrijving"]?></a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Spelers aanmelden
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="?proces=handmatig&toernament=<?php echo $_SESSION["toernooiId"]; ?>">Handmatig</a>
                            <a class="dropdown-item" href="?proces=import&toernament=<?php echo $_SESSION["toernooiId"]; ?>">Importeren</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?proces=uitslagenbeheer&toernament=<?php echo $_SESSION["toernooiId"]; ?>">Uitslagen beheren</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="?proces=uitslagen&toernament=<?php echo $_SESSION["toernooiId"]; ?>">Toernooi Overzicht</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="beheer.php?id=<?php echo $_SESSION["toernooiId"]; ?>">Toernooi Overzicht</a>
                    </li>

                </ul>
                <span class="navbar-text">

                <?php if($toernooi["status"] != 1):?>
                        <a class="btn btn-danger" href="sluiten.php"><i class="fas fa-window-close"></i> Sluit toernooi</a>
                <?php endif;?>
                </span>
            </div>
        </nav>

    <div class="row">
        <?php
        if( isset($_GET["proces"]) && $_GET["proces"] == "handmatig" && isset($_SESSION["toernooiId"]) ):
            include "aanmelding/handmatig.php";
        elseif( isset($_GET["proces"]) && $_GET["proces"] == "import" && isset($_SESSION["toernooiId"]) ):
            include "aanmelding/importeren.php";
        elseif( isset($_GET["proces"]) && $_GET["proces"] == "uitslagenbeheer" && isset($_SESSION["toernooiId"]) ):
                include "uitslag/beheren.php";
        // elseif( isset($_GET["proces"]) && $_GET["proces"] == "uitslagen" && isset($_SESSION["toernooiId"]) ):
        //         include "uitslag/overzicht.php";
        else:
            include "uitslag/overzicht.php";
        endif;
        ?>




    </div>
</div>




<?php include PROJECT_PATH ."/incl/footer.php"; ?>
