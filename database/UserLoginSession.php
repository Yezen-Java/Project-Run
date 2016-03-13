<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include 'Connect.php';


function loginUserSession(){

$username = $_POST['form-username'];
$password = $_POST['form-password'];

$escape = pg_escape_string($username);
$result = pg_query("SELECT * FROM users WHERE Username='{$escape}'");

if ($result) {
	$row = pg_fetch_row($result);
	$userId = $row[0];
	$usernameR = $row[3];
	$passwordR = $row[5];
}
if($username === $usernameR  && $password === $passwordR){
	$_SESSION['username'] = $username;
	$_SESSION['id'] = $userId;
	pg_close();
   header('Location: index.php');
}else{
	echo " Incorrect Username or Password";
}

}


?>