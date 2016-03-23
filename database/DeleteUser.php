<?php

/**
 * function call 'deleteUsers'
 * @author Yezen Alnafei
 * @version 1.0
 *
 */

include 'Connect.php';
include 'signUpValidation.php';
include 'LoadDataOnstart.php';

$userId = $_POST['userId'];

$userClass = new UserClass();

$results = $userClass->deleteUsers($userId,$dbconn);

if ($results) {

	echo true;

}else{

	echo false;
}


?>