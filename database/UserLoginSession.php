<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include 'Connect.php';

$username = $_POST['form-username'];
$password = $_POST['form-password'];


function loginUserSession(){

$query = "SELECT * FROM users WHERE Username=$1";

$result = pg_prepare($dbconn, "query",$query);
$result = pg_execute($dbconn, "query", array($username));
	
if($row = pg_fetch_row($result)>0){
	$userId = $row[0];
	$usernameR = $row[3];
	$passwordR = $row[5];

		if($username === $usernameR  && $password === $passwordR){
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $userId;
		   header('Location: index.php');
		}else{
			echo " Incorrect Username or Password";
	}
}else{
	echo " Incorrect Username or Password";
}

}

?>