<?php

include 'Connect.php';

include 'LoadDataOnstart.php';


$LoadDataOnstart = new LoadOnStart();

$refreshList = $LoadDataOnstart->MediaSelectFucntion();

echo $refreshList;




?>