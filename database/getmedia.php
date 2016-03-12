<?php 


include 'Connect.php';




$mediaResults = pg_query("SELECT * from media");


if ($mediaResults) {
	
while ($rows =pg_fetch_array($mediaResults)) {

	$link = $rows['link'];
	$name = $rows['media_name'];

	echo "<div class='col-md-3 col-sm-4 col-xs-6'>
              <img src='$link' alt='$name' style='width:100px;height:150px;'>
         </div>";
}

}
 ?>