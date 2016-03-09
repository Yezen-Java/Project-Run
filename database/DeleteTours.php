<?php

include 'Connect.php';


$GetTourID = $_POST['TourID'];

$DeleteQuery = pg_query("DELETE FROM tour where tourid =''");

if ($DeleteQuery) {
	echo "Tour Deleted Successfully";
}


?>