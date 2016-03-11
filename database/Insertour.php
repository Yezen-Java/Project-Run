<?php 

error_reporting(E_ALL & ~E_NOTICE);
session_start();
include "Connect.php";

$tourID = $_POST['TourID'];
$tourName = $_POST['Tourname'];
$tourDate = $_POST['TourDate'];
$username= $_SESSION['username'];

$escape = pg_escape_string($tourID);

$TourIDCheck = pg_query("SELECT * from tour where tourid = '$escape'");

$TourNumberIDs = pg_num_rows($TourIDCheck);

if ( $TourNumberIDs == 0) {
	// $tourQuery = pg_query("INSERT INTO tour Values('$tourID', '$tourName','$tourDate')");
 //    $result = pg_query("INSERT INTO usertour Values('$username','$tourID')");
    $query = "INSERT INTO tour Values($1, $2,$3)";
    $tourQuery = pg_prepare($dbconn,"query", $query);
    $tourQuery = pg_execute($dbconn,"query",  array($tourID,$tourName,$tourDate));
    
    $query1 = "INSERT INTO usertour Values($1,$3)";
    $result = pg_prepare($dbconn,"query1", $query1);
    $result = pg_execute($dbconn,"query1",  array($username,$tourID));

if ($tourQuery && $result) {
	echo "TourCreated";


	}else{
		echo $username;
	}
	
}else{

	echo "Tour ID already exsits";
}






?>