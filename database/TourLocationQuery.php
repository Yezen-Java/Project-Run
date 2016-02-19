<?php 

$tourCode = pg_escape_string($_POST['TourCode']);
$result = pg_query( "SELECT latitude, logitude from tour r, tour_res tr, location l where r.tourgode = '$tourCode' and tr.tourid = r.tourid and tr.locationid = l.locationid;");

  while ($rows =pg_fetch_array($result)) {

  	echo $row['latitude'];
  	echo $row['logitude'];

        }
?>