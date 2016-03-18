<?php

include 'Connect.php';
include 'Classes/LocationClass.php';
include 'LoadDataOnstart.php';

$arrayIds = $_POST['LocationIds'];

$array = explode("::", $arrayIds);

echo $array ;

$Locationclass = new LocationClass();


$CheckLocationDeleted = $Locationclass->deleteLocations($array,$dbconn);


if ($CheckLocationDeleted) {

	$LoadOnStart = new LoadOnStart();

	echo $LoadOnStart->getLocationManager();
}else{

	echo $CheckLocationDeleted ;

}



?>