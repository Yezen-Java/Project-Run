<?php

include 'Connect.php';
include 'signUpValidation.php';

$userid = $_POST['Usernameid'];
$number = $_POST['Number'];


$userClass = new UserClass();

$CheckActivity = $userClass->setUserActivition($userid,$number,$dbconn);


if ($CheckActivity) {
	echo $CheckActivity;
}else{

	echo $CheckActivity;
}

?>