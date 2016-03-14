<?php 

include'Connect.php';

$tourId = $_POST['TourID'];

echo $tourid;


echo getLocation();



	function getLocation(){
		global $dbconn;
		global $tourId;

		$query= "SELECT * from tour_res where tourid = $1"; 
		$results =pg_prepare($dbconn, "selectquery",$tourId);

		$results =pg_execute($dbconn,"selectquery",array("TOR124"));

	    $menu = array();
        while ($row = mysql_fetch_array($query)) {
	        $menu[] = array($row['id']);
	  
        }

        return json_encode($menu);

	} 


?>