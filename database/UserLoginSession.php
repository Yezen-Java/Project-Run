<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$username = $_POST['form-username'];
$password = $_POST['form-password'];
$result = pg_query("SELECT * FROM users WHERE Username='$username'");

if ($result) {
		$row = pg_fetch_row($result);

	echo $row[0];
}

if ($result) {
	$row = pg_fetch_row($result);
	$userId = $row[0];
	$usernameR = $row[4];
	$passwordR = $row[5];
}
if($username === $usernameR  && sha1($password)=== $passwordR){
	$_SESSION['username'] = $username;
	$_SESSION['id'] = $userId;
   header('Location: index.php');
}else{
	echo " Incorrect Username or Password";
}


?>