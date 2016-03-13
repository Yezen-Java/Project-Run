<?php

include 'Connect.php';


$location = $_POST['locationNo'];
$lis = $_POST['items'];
$liarray = explode("::", $lis);
$le = count($liarray);

function functionName(){
global $le;
global $liarray;
global $location;
global $dbconn;
    $query = "INSERT into location_res(locationid,mediaid) values ($1,$2);";
	$result = pg_prepare($dbconn,"query", $query);
for ($i=0; $i < $le;$i++) { 
	# code...
	$result = pg_execute($dbconn,"query",  array($location,$liarray[$i]));
	$cmdtuples = pg_affected_rows($result);
	if ($cmdtuples > 0) {
			
		echo"MeidaId $meidaId been added to LocationId $location";

	}else{

		echo "Faild";
	}

}

}

functionName();




?>