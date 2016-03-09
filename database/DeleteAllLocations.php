<?php

$usernameID = $_POST['UsernameID'];
$password = $_post['pass'];

$CheckUserQuery = pg_query("SELECT * From Users where username='$usernameID'");

if ($CheckUserQuery) {

$rows = pg_fetch_array($CheckUserQuery);

$userFromResult = $rows['username'];
$passFromResult = $rows['username'];

if ($usernameID == $userFromResult && $password === $passFromResult) {
	
	$deleteQuery = pg_query("DELETE FROM Location cascade;");

	if ($deleteQuery) {
			
			echo "ALL Locations Where Deteleted";

	}else{

		echo"Database not avaliable please try Again";
	}



}else{

	echo "User Acount invalid";
}

}

?>