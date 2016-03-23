<?php


/**
 * function call 'editLocaitonName'.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

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

