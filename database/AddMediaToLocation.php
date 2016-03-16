<?php

include 'Connect.php';
include 'Classes/MediaManagerClass.php';


$location = $_POST['locationNo'];
$lis = $_POST['items'];
$liarray = explode("::", $lis);
$le = count($liarray);

$Addmedia = new MediaManager();
$Addmedia-> addMeidaToLocation($le,$liarray,$location,$dbconn);


// class Addmedia 
// {

// public function addMeidaToLocation($le,$liarray,$location,$dbconn){

//     $query = "INSERT into location_res(locationid,mediaid) values ($1,$2);";
// 	$result = pg_prepare($dbconn,"query", $query);
//     for ($i=0; $i < $le;$i++) { 
// 		# code...
// 		$result = pg_execute($dbconn,"query",  array($location,$liarray[$i]));
// 		$cmdtuples = pg_affected_rows($result);
// 		if ($cmdtuples > 0) {
// 			$mediaid = $liarray[$i];
// 			echo"MeidaId $mediaid been added to LocationId $location";

// 		}else{

// 			echo "Faild";
// 		}

// 	}

// }

// }




?>