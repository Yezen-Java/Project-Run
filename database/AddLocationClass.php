<?php 

include'Connect.php';
include'Classes/LocationClass.php';

$tourId = $_POST['TourID'];

$locationIdArray = $_POST['items'];

$liarray = explode("::", $locationIdArray);

$location = new LocationClass();

$LocationsAdded = $location ->insertLocations($tourId,$liarray);

echo $LocationsAdded;





?>