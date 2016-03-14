<?php 


$tourId = $_POST['TourID'];

$locationId = $_POST['LocationID'];

//$uncheckedboxs = $_POST['Unchecked'];




$locationClass = new AddLocations($tourId,$locationId,$dbconn);

echo $locationClass->getLocation();

echo "working";

class AddLocations

{

	private $tourId;
	private $locationId;
	private $unchckedLocations;
	private $databaseConnection;

   function __construct($tourid,$locationId) {
   	$this->tourId = $tourid;
   	$this->locationIdArray = $locationId;
   	//$unchckedLocations = $unchecked;
   	$this->databaseConnection = $dbconn;
   }

	function getLocation(){
		global $dbconn;

		$query= "SELECT * from tour_res where tourid = $1"; 
		$results =pg_prepare($dbconn, "selectquery",$query);

		$results =pg_execute($dbconn,"selectquery",array($this->TourId));

	    $menu = array();
        while ($row = mysql_fetch_array($query)) {
	        $menu[] = array($row['id']);
	  
        }
        return json_encode($menu);

	} 

	// function deleteFromUnchecked(){


	// $unchecked = $this->unchckedLocations;

	// $liarray = explode("::", $unchecked);

	// $le = count($liarray);
	// $query = "DELETE FROM tour_res where locationid = $1";
	// $result = pg_prepare($dbconn,"queryDelete",$query);

	// for ($i=0; $i < $le; $i++) { 

	// 	$result = pg_execute($dbconn,"queryDelete",$liarray[$i]);

	// 	if (pg_affected_rows($result)>0) {
			
	// 		return true;
	// 	}
		
	// }

	// return false;


	// }


	// function insertLocation(){

	// 	global $tourid;
	// $addLocationTourQ = "INSERT into tour_res values ($1,$2)";
	// $addLocationQueryt = pg_prepare($dbconn,"addLocationQuery", $addLocationTourQ);

 //    $liarray = explode("::", $this->locationId);
	// $le = count($liarray);

	// for ($i=0; $i < $le; $i++) { 

	// $addLocationQueryt = pg_execute($dbconn,"addLocationQuery",  array($this->tourId,$liarray[$i]));
   
 //    }

	// if (pg_affected_rows($addLocationQueryt)) {
	// 	echo"Locations has been addded";
	//  return true;
	// }
	// return false;

	// }
	
}




 ?>