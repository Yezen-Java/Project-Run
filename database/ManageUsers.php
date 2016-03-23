<?php

/**
 * function call 'setUserActivition'.
 * set user activition  by the user.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */
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