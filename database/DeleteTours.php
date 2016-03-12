<?php

include 'Connect.php';


$GetTourID = $_POST['TourID'];

$query = "DELETE FROM tour where tourid =$1";

$result = pg_prepare($dbconn,"delete_query", $query);

if ($result) {
	$result = pg_execute($dbconn,"delete_query", array($GetTourID));
	echo "Tour Deleted Successfully";

}


?>