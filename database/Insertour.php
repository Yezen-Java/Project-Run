<?php 

include "Connect.php";

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];



$TourIDCheck = pg_query("SELECT * from tour where tourid = '$tourID'");

$TourNumberIDs = pg_num_rows($TourIDCheck);

if ( $TourNumberIDs == 0) {

	$tourQuery = pg_query("INSERT INTO tour Values('$tourID', '$tourName','$tourDate')");

    $result = pg_prepare($dbconn, "my_query", 'INSERT into usertour values($1,$2)');
    $result = pg_execute($dbconn, "my_query", $username, $tourid);




if ($tourQuery) {
	echo "TourCreated";


	}else{
		echo "Tour Creation Failed, Try again";
	}
	
}else{

	echo "Tour ID already exsits";
}






?>