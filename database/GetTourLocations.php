<?php 

include'Connect.php';

$TouridCode = $_GET["p"];


$query = pg_query("SELECT * from tour_res tr, location l  where tourid = 'TOR123 ' and tr.locationid = l.locationid;");


$dataArray = array();
if($query){
	while ($row = pg_fetch_array($query)) {
	$dataArray = $row;

}


}else{

	echo "No locations were added";
}

echo json_encode($dataArray);

?>