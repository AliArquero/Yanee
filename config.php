<?php
//set constants for use in application
define('ROOT_PATH', dirname(__DIR__));
// echo ROOT_PATH . "<br>";
define("PROJECT_PATH", ROOT_PATH . "/MBO-OPEN/");
// echo PROJECT_PATH. "<br>";
define("BASE_URL", "/MBO-OPEN/");
// echo BASE_URL. "<br>";

error_reporting(E_ALL);
foreach (glob(PROJECT_PATH. "/classes/*.php") as $filename)
{
    include $filename;
}


$speler_object = new Speler();
$school_object = new School();
$toernooi_object = new Toernooi();

$aanmelding_object = new Aanmelding();
$wedstrijd_object = new Wedstrijd();
?>
