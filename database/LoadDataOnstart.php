<?php

include 'Connect.php';

error_reporting(E_ALL & ~E_NOTICE);
session_start();

function getTourList(){

$username= $_SESSION['username'];
//$queryTour ="SELECT * From Tour, usertour where usertour.username = $1 and usertour.tourid = tour.tourid";
//$toursListQuery =pg_prepare($dbconn, "toursListQuery1", $queryTour);
$escape = pg_escape_string($username);
$toursListQuery = pg_query("SELECT * From Tour, usertour where usertour.username = '$escape' and usertour.tourid = tour.tourid");
 //$toursListQuery = pg_execute($dbconn,"toursListQuery1", array($username));
if (pg_num_rows($toursListQuery)>0) {
 	    while ($rows =pg_fetch_array($toursListQuery)) {
            $tour_id =$rows["tourid"];
            $tour_name =$rows["tour_name"];

          echo "<li id='$tour_id'> 
              <div class='input-group'> 
              <span class='input-group-addon'> 
                <button class='glyphicon glyphicon-trash' id='$tour_id' onclick='deleteTourLi(this.id)'></button> 
              </span> <button type='button' class='list-group-item tourButtons' value='$tour_id' onclick='w3_open(this.value)'>$tour_name $tour_id</button> </div> </li>";
            }  
}
else{
	echo "No Data Found";
}

}


function GetLocationQuery(){


$locationsQuery = pg_query("SELECT * From location");

if ($locationsQuery) {
	

echo"<select id ='selectLocation' class='form-control'>";
         echo"<option>Choose Room To Add:</option>";
         while($rows = pg_fetch_array($locationsQuery)){
          $id = $rows['locationid'];
          $name = $rows['lname'];
          echo"<option value='$id'>$name</option>";
         }
         echo"</select>";
}else{
	echo "No Location where Found";
}
}



function getLocationList(){

$locationsQuery2 = pg_query("SELECT * From location");

if ($locationsQuery2) {
    echo"<ul>";
    while($rows = pg_fetch_array($locationsQuery2)){
    $id = $rows['locationid'];
    $name = $rows['lname'];
    echo"<li value='$id'>$name</li>";
}
    echo"</ul>";
}else{
	echo "noLocationsFound";
}
}

function mediaResultsFucntion(){

$mediaResults = pg_query("SELECT * from media");

if ($mediaResults) {
	# code...
	while ($rows =pg_fetch_array($mediaResults)) {

	  $link = $rows['link'];
	  $name = $rows['media_name'];
	  $mediaid = $rows['mediaid'];

	  echo "<div class='col-md-4 portfolio-item' id='$mediaid'>
	    <img class='img-responsive' src='$link' max-width='100%' height='auto'>
	    <h3>$name</h3>

      <div class='form-group'>
        <label for='comment'>Description:</label>
        <textarea class='form-control' rows='5' id='$mediaid'></textarea>
      </div>

      <div class='displayCheckBoxSpan'>
	    <span class='input-group-addon' id='checkBoxDeleteSpan'>
	        <input type='checkbox' name='checkboxmedia[]' value ='$mediaid'>
	      </span></div></div>";
}
     
}else{
	echo "No Data found";
}

}

function MediaSelectFucntion(){
$MediaSelect = pg_query("SELECT * from media");

if (condition) {
	# code...
	echo "<select id='MediaSelectId' class='form-control' onchange='addmeidaFromSelectList();'>";
        while($rows = pg_fetch_array($MediaSelect)){
        $mediaid = $rows['meidaid'];
        $mediaName = $rows['media_name'];
        echo "<option id='option' value='$mediaid'>$mediaName</option>";

    }
    echo "</select>";
}
}

?>