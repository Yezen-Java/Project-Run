<?php 

include 'Connect.php';

$tourId = $_POST['TourID'];

$locationId = $_POST['LocationID'];


$addLocationTourQ = "INSERT into tour_res values ($1,$2)";


$addLocationQueryt = pg_prepare($dbconn,"addLocationQuery", $addLocationTourQ);


$addLocationQueryt = pg_execute($dbconn,"addLocationQuery",  array($tourId,$locationId));

if ($addLocationQueryt) {

echo "Location Added";
	
}else{

	echo "Something went wrong";
}


 ?>