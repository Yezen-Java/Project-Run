<?php 

include'Connect.php';

$TouridCode = $_POST['TourID'];


$query = pg_query("SELECT * from tour_res tr, location l  where tourid ='$TouridCode' and tr.locationid = l.locationid;");

$rows = array();

if($query){
while($r = mysql_fetch_assoc($query)) {
  $rows[] = $r;
}
}else{
	echo "No locations were added";
}
echo json_encode($rows);

?>