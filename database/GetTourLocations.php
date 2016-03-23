<?php 

/**
 * function call 'getLocations'.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

include 'Connect.php';
include 'Classes/LocationClass.php';
$TouridCode = $_POST['value'];

$locationClass = new LocationClass();

$geetLocations = $locationClass->getLocation($TouridCode);

echo $geetLocations;


?>