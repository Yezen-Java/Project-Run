<?php 

include 'Connect.php';
include 'Classes/LocationClass.php';
$TouridCode = $_POST['value'];

$locationClass = new LocationClass();

$geetLocations = $locationClass->getLocation($TouridCode);

echo $geetLocations;


?>