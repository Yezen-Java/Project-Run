<?php

/**
 * function call 'Destory user session'.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */
error_reporting(E_ALL & ~E_NOTICE);
session_start();
session_destroy();

header( 'Location: https://arcane-cove-15853.herokuapp.com/login.php') ; 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Loged Out</title>
</head>
<body>

<h1>You have Successfully Loged out</h1></br>
<button type="button" action="login.php">login</button>
</body>
</html>