<?php

include 'Connect.php';
include 'signUpValidation.php';
include 'LoadDataOnstart.php';

$userId = $_POST['userId'];

$userClass = new UserClass();

$results = $userClass->deleteUsers($userId,$dbconn);

if ($results) {

$loadOnStart =  new LoadOnStart();

$htmlData = $loadOnStart->getUsersAccounts();

echo $htmlData;


}else{

	echo false;
}


?>