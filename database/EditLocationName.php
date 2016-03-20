<?php

include'Connect.php';
include'Classes/LocationClass.php';

$locationId = $_POST['LocationId'];
$newLocationName = $_POST['NewLocationName'];


$locationClass = new LocationClass();

$checkLocation = $locationClass->editLocaitonName($newLocationName, $locationId,$dbconn);

if($checkLocation){

	echo true;

}else{

	echo false;
}


?>

