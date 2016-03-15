<?php

include 'Connect.php';

class LocationClass 
{


	public function getLocation($TouridCode){

	   global $dbconn;

		$getLocations = '';
		$escapedId = pg_escape_string($TouridCode);

		$queryString = "SELECT * from tour_res, location where tourid ='{$escapedId}' and tour_res.locationid = location.locationid";
		$query = pg_query($queryString);

		if (pg_num_rows($query ) == 0) {
			$getLocations =  "No location returned";
		}else{

		while($row = pg_fetch_array($query)) {
			$locationname = $row['lname'];
			$locationId = $row['locationid'];

			//this generates a list based on the number of the locations.

		$getLocations =  $getLocations."<a href ='#'id ='pointer1' value ='$locationId' onclick='addLocationRes($locationId)'>$locationname</a>
		<button type='button' value ='$locationId' class='btn btn-default btn-sm'>
		          <span class='glyphicon glyphicon-trash'></span> Trash 
		        </button>";
		    }

		}

		return $getLocations;

	}



	public function DeleteLocation(){

	

	}


	public function insertLocations($tourId,$liarray){

		global $dbconn;

	$le = count($liarray);
	$addLocationTourQ = "INSERT into tour_res values ($1,$2)";
	$addLocationQueryt = pg_prepare($dbconn,"addLocationQuery", $addLocationTourQ);

	for ($i=0; $i < $le; $i++) { 

	$addLocationQueryt = pg_execute($dbconn,"addLocationQuery",  array($tourId,$liarray[$i]));
   
    }

	if (pg_affected_rows($addLocationQueryt)>0) {
		return true;

	}


	return false;


	}
	

}




?>