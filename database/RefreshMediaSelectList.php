<?php

/**
 * function call 'MediaSelectFucntion'.
 * @author Yezen Alnafei
 * @version 1.0
 *
 */
include 'Connect.php';
include 'LoadDataOnstart.php';
$LoadDataOnstart = new LoadOnStart();
$refreshList = $LoadDataOnstart->MediaSelectFucntion();
echo $refreshList;

?>