
<?php

include 's3_config.php';
include 'Connect.php';
include 'image_check.php';


class MediaManager 
{


private $s3;
use Aws\S3\S3Client;

public function amazonS3(){

$bucket="storage.s3.website.com";
if (!class_exists('S3'))require('s3.php');

			
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJQAUHJ7XGYHTS6AQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

}

public function addLocationTour($le,$liarray,$location,$dbconn){

    $query = "INSERT into location_res(locationid,mediaid) values ($1,$2);";
	$result = pg_prepare($dbconn,"query", $query);
    for ($i=0; $i < $le;$i++) { 
		# code...
		$result = pg_execute($dbconn,"query",  array($location,$liarray[$i]));
		$cmdtuples = pg_affected_rows($result);
		if ($cmdtuples > 0) {
			$mediaid = $liarray[$i];
			echo"MeidaId $mediaid been added to LocationId $location";

		}else{

			echo "Faild";
		}

	}

}



public function deleteMeida($arrayMedia){

	global $dbconn;
	$checkDelete = 0;

$query = "DELETE From media where mediaid = $1";
$query2 = "SELECT * From media where mediaid = $1";

$result = pg_prepare($dbconn,"query", $query);
$amazonQuery = pg_prepare($dbconn,"query2", $query2);


foreach ($arrayMedia as $number) {

	$amazonQuery = pg_execute($dbconn,"query2", array($number));
	$rows = pg_fetch_array($amazonQuery);
	$mediaExt = $rows['ext_name'];
	
	if ($this->s3->deleteObject($bucket,$mediaExt)) {
	 $result = pg_execute($dbconn,"query",  array($number));

	 $checkDelete++;

	}else{

		$checkDelete--;
}


sleep(1);

}

return $checkDelete;

}

}

?>