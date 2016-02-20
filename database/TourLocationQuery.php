<?php 

$dbconn = pg_connect("host=ec2-107-21-221-59.compute-1.amazonaws.com dbname=da2vmjb6giivfh user=enybctwamdyitl
 password=z3paibkPjPYeWNWib9d3nD0Pi8")
or die('Could not connect: ' . pg_last_error());

$tourCode = $_POST['TourCode'];
$result = pg_query( "SELECT latitude, logitude from tour r, tour_res tr, location l where r.tourgode = '$tourCode' and tr.tourid = r.tourid and tr.locationid = l.locationid;");

  while ($rows =pg_fetch_array($result)) {

  	echo $row['latitude'];
  	echo $row['logitude'];

        }



        if (!$result) {

        	echo "Query Failed";
        }
?>