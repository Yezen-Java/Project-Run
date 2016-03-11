<?php

include 's3_config.php';
include 'database/Connect.php';

$mediaid = $_POST['checkBoxesDelete']; 

echo count($mediaid);

$query = "DELETE From media where mediaid = $1";
$query2 = "SELECT * From media where mediaid = $1";

$result = pg_prepare($dbconn,"query", $query);
$amazonQuery = pg_prepare($dbconn,"query2", $query2);


foreach ($mediaid as $number) {

	$amazonQuery = pg_execute($dbconn,"query2",  array($number));
	$rows = pg_fetch_array($amazonQuery);
	$mediaExt = $rows['ext_name'];

	if ($s3->deleteObject($bucket,$mediaExt)) {
	 $result = pg_execute($dbconn,"query",  array($number));

        	echo 'Deleted';

	}else{
		echo "error";
}


sleep(1);

}


?>