<?php

include 'Connect.php';

/**
 * LocationClass.php
 * Location managent
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

class LocationClass 
{

    /*
    get locaitons for for specific tour code, 
    */
	public function getLocation($TouridCode){

	   global $dbconn;

		$getLocations = '';
		$escapedId = pg_escape_string($TouridCode);
		//query to get all the locatiom for the tour.
		$queryString = "SELECT * from tour_res, location where tourid ='{$escapedId}' and tour_res.locationid = location.locationid";
		$query = pg_query($queryString);
		if (pg_num_rows($query ) == 0) {
			$getLocations =  "No location returned";
		}else{
			//fetch the rows of the results re query.
		while($row = pg_fetch_array($query)) {
			$locationname = $row['lname'];
			$locationId = $row['locationid'];

			//this generates a list based on the number of the locations.
		$getLocations =  $getLocations."<a href ='#myModal' class='previousLocations' data-toggle='modal' value ='$locationId' name='$locationname' onclick='addLocationRes($locationId,this.name,this)'>$locationname</a>";
		    }

		}

		//return the html tag with the data form teh query.
		return $getLocations;

	}

	/*
	Insert locations for a tour,
	*/
	public function insertLocations($tourId,$liarray){
		//get the db accesss permission
	global $dbconn;
	//queru for deleting the existing locations for the tour,
	$queryDelere = "DELETE FROM tour_res where tourid = $1";
	$DelereQuery = pg_prepare($dbconn,"deletequery", $queryDelere);
	$DelereQuery = pg_execute($dbconn,"deletequery", array($tourId));
	$le = count($liarray);
	// query for adding the new locations for teh tour.
	$addLocationTourQ = "INSERT into tour_res values ($1,$2)";
	$addLocationQueryt = pg_prepare($dbconn,"addLocationQuery", $addLocationTourQ);
	for ($i=0; $i < $le; $i++) { 
	$addLocationQueryt = pg_execute($dbconn,"addLocationQuery",  array($tourId,$liarray[$i]));
    }
    //check whrether rows where affected, if so return true.
		if (pg_affected_rows($addLocationQueryt)>0) {
			return true;
		}

	return false;

	}

	/*
	Delete  unwnated locations from the location mannager.
	*/
	public function deleteLocations($arrayLocations, $dbconn){
		//query for deleting locations based on the id.
		$query = "DELETE from location where locationid = $1";
		//prepare the query.
	    $DeleteQuery = pg_prepare($dbconn,"deletequery", $query);
	    $le = count($arrayLocations);
	    for ($i=0; $i < $le; $i++) { 
	    	//pass the parameters to the query to be executed.
			$DeleteQuery = pg_execute($dbconn,"deletequery", array($arrayLocations[$i]));
	    }
	    //check whether the query took effect. 
	    if (pg_affected_rows($DeleteQuery)>0) {
	    	return true;
	    }
	    return false;
	}

	/*
	Edit existing location name.
	*/

	public function editLocaitonName($newLocationName, $locationId,$dbconn){
		//update query for updating location name based on the location ID.
		$Query = "UPDATE location set lname = $1  where locationid = $2";
		//perpare the statement.
		$results = pg_prepare($dbconn,"Query",$Query);
		$results = pg_execute($dbconn,"Query",array($newLocationName,$locationId));
		//check whether teh query took effect.
		if (pg_affected_rows($results)>0) {
			return true;
		}
		    return false;
	}



}




?>