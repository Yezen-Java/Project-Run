<?php 

include'Connect.php';

$tourId = $_POST['TourID'];

$locationIdArray = $_POST['LocationId'];

$liarray = explode("::", $locationIdArray);
$le = count($liarray);

	function insertLocation(){
		global $tourId;
        global $liarray;

	$addLocationTourQ = "INSERT into tour_res values ($1,$2)";
	$addLocationQueryt = pg_prepare($dbconn,"addLocationQuery", $addLocationTourQ);

	for ($i=0; $i < $le; $i++) { 

	$addLocationQueryt = pg_execute($dbconn,"addLocationQuery",  array($tourId,$liarray[$i]));
   
    }

	if (pg_affected_rows($addLocationQueryt)) {
		echo"Locations has been addded";

	}


}


insertLocation();


?>