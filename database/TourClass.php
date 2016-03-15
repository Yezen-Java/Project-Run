<?php

include 'Connect.php';


/**
* 
*/

class TourClass
{
	public function insertTour($escapeTourid,$escapeTName,$escapeTD,$escapeUser){

		global $dbconn;
		$msg ='work';

		$TourIDCheck = pg_query("SELECT * from tour where tourid = '$escapeTourid'");

		$TourNumberIDs = pg_num_rows($TourIDCheck);

		if ( $TourNumberIDs == 0) {
			$tourQuery = pg_query("INSERT INTO tour Values('$escapeTourid', '$escapeTName','$escapeTD')");
			$result = pg_query("INSERT INTO usertour Values('$escapeUser','$escapeTourid')");

			if ($tourQuery && $result) {
				$msg = "TourCreated";


				}else{
					$msg ='Some went wrong';
				}
				
			}else{

				$msg ="Tour ID already exsits";
			}


			return $msg;



	}



	

}





?>