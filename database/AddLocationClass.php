<?php 

/**
 * LocationClass.php
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

// include Database class and location class.
include'Connect.php';
include'Classes/LocationClass.php';

$tourId = $_POST['TourID'];
$locationIdArray = $_POST['items'];
$liarray = explode("::", $locationIdArray);
//Create instance of the locationCLass.
$location = new LocationClass();
$LocationsAdded = $location ->insertLocations($tourId,$liarray);
echo $LocationsAdded;





?>