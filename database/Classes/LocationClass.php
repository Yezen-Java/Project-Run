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

		$getLocations =  $getLocations."<a href ='#myModal' class='previousLocations' data-toggle='modal' value ='$locationId' name='$locationname' onclick='addLocationRes($locationId,this.name,this)'>$locationname</a>";
		    }

		}

		return $getLocations;

	}



	public function insertLocations($tourId,$liarray){

	global $dbconn;
	$queryDelere = "DELETE FROM tour_res where tourid = $1";
	$DelereQuery = pg_prepare($dbconn,"deletequery", $queryDelere);
	$DelereQuery = pg_execute($dbconn,"deletequery", array($tourId));

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


	public function deleteLocations($arrayLocations, $dbconn){
		$query = "DELETE from location where locationid = $1";
	    $DeleteQuery = pg_prepare($dbconn,"deletequery", $query);
	    $le = count($arrayLocations);

	    for ($i=0; $i < $le; $i++) { 
	    	# code...
			$DeleteQuery = pg_execute($dbconn,"deletequery", array($arrayLocations[$i]));
	    
	    }
	    if (pg_affected_rows($DeleteQuery)>0) {
	    	return true;
	    }
	    return false;


	}



	public function editLocaitonName($newLocationName, $locationId,$dbconn){
		$Query = "UPDATE location set lname = $1  where locationid = $2";
		$results = pg_prepare($dbconn,"updateQuery",$Query);
		$results = pg_execute($dbconn,"updateQuery",array($newLocationName,$locationid));

		if (pg_affected_rows($results)>0) {
			return true;
		}

		return false;
	}



}




?>