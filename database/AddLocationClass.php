<?php 

include'Connect.php';

$tourId = $_POST['TourID'];

$locationIdArray = $_POST['LocationId'];

$ClassName = new ClassName($tourId,$locationIdArray);

/**
* 
*/
class ClassName{

	private $tourId;
	private $locationId;
	
	function __construct($tourid, $Locations)
	{

		$this->tourid = $tourid;
		$this->locationId = $Locations;
	}


function deleteFromUnchecked(){

	$liarray = explode("::", $this->locationId);

	$le = count($liarray);
	$query = "DELETE FROM tour_res where locationid = $1";
	$result = pg_prepare($dbconn,"queryDelete",$query);

	for ($i=0; $i < $le; $i++) { 

		$result = pg_execute($dbconn,"queryDelete",$liarray[$i]);

		if (pg_affected_rows($result)>0) {
			
			return true;
		}
		
	}

	return false;


	}


	function insertLocation(){

	$addLocationTourQ = "INSERT into tour_res values ($1,$2)";
	$addLocationQueryt = pg_prepare($dbconn,"addLocationQuery", $addLocationTourQ);

    $liarray = explode("::", $this->locationId);
	$le = count($liarray);

	for ($i=0; $i < $le; $i++) { 

	$addLocationQueryt = pg_execute($dbconn,"addLocationQuery",  array($this->tourId,$liarray[$i]));
   
    }

	if (pg_affected_rows($addLocationQueryt)) {
		echo"Locations has been addded";
	 return true;
	}
	return false;

	}

}



?>