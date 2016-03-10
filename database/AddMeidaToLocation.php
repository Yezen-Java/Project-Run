<?php

include 'Connect.php';

$meidaId = $_POST['MeidaID'];
$location = $_POST['LocationID'];

$query = "INSERT into location_res(locationid,link) values ($1,$2)";

$result = pg_prepare($dbconn,"query", $query);

$result = pg_execute($dbconn,"query",  array($nameData,$nameLink));


if ($result) {

	echo"MeidaId "+$meidaId+"been added to LocationId"+$location;
}else{

echo "Faild";

}




sleep(1);


?>