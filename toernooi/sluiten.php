<?php
session_start();
include "../config.php";


$wedstrijd_object->genereerRonde1($_SESSION["toernooiId"]);
// die;
$toernooi = $toernooi_object->setStatus($_SESSION["toernooiId"] , 1);


header("location: beheer.php");
