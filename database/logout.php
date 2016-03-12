<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
session_destroy();

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