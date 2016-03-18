<?php

include 'Connect.php';
include 'Classes/LocationClass.php';
include 'LoadDataOnstart.php';

$arrayIds = $_POST['LocationIds'];
$arrayLocations = explode(".", $arrayIds);
$Locationclass = new LocationClass();
$CheckLocationDeleted = $Locationclass->deleteLocations($arrayLocations,$dbconn);

if ($CheckLocationDeleted) {
	$LoadOnStart = new LoadOnStart();
	echo $LoadOnStart->getLocationManager();
	}else{
	 	echo $CheckLocationDeleted ;
	}



?>