<?php

include 'Connect.php';

error_reporting(E_ALL & ~E_NOTICE);
session_start();


class LoadOnStart{

public function getTourList(){

$username= $_SESSION['username'];
$htmltage ='';
$escape = pg_escape_string($username);
$toursListQuery = pg_query("SELECT * From Tour, usertour where usertour.username = '{$escape}' and usertour.tourid = tour.tourid");

if (pg_num_rows($toursListQuery)>0) {
      while ($rows =pg_fetch_array($toursListQuery)) {
            $tour_id =$rows["tourid"];
            $tour_name =$rows["tour_name"];
       $htmltage = $htmltage. "<li id='$tour_id'>  
                  <div class='input-group'>
                    <span class='input-group-addon'> 
                      <button class='glyphicon glyphicon-trash' id='$tour_id' onclick='deleteTourLi(this.id)' ></button> 
                    </span>
                    <button type='button' class='list-group-item tourButtons' name ='$tour_name' value='$tour_id' onclick='w3_open(this.value,this.name)' ondblclick='EditTourName(this.value,this.name);'>$tour_name $tour_id</button>
                  </div>
              </li>";
      }  
}
else{
  $htmltage = "Create new Tour";
}

return $htmltage;

}


// public function GetLocationQuery(){


// $locationsQuery = pg_query("SELECT * From location");

// if ($locationsQuery) {
  

// echo"<select id ='selectLocation' class='form-control'>";
//          echo"<option>Choose Room To Add:</option>";
//          while($rows = pg_fetch_array($locationsQuery)){
//           $id = $rows['locationid'];
//           $name = $rows['lname'];
//           echo"<option value='$id'>$name</option>";
//          }
//          echo"</select>";
// }else{
//  echo "No Location where Found";
// }
// }



public function getLocationList(){

$locationsQuery2 = pg_query("SELECT * From location");

if ($locationsQuery2) {
    echo"<ul>";
    while($rows = pg_fetch_array($locationsQuery2)){
      $id = $rows['locationid'];
      $name = $rows['lname'];
      echo"<li value='$id'>
      <div class='checkbox'>
        <label><input type='checkbox' class='checkLocation' id='$id' value='$id' name='checkboxlocation'>$name</label>
      </div></li>";
    }
  echo"</ul>";
  }else{
    echo "noLocationsFound";
  }
}

public function mediaResultsFucntion(){
  $htmlTage = '';
$mediaResults = pg_query("SELECT * from media order by mediaid ASC");

if ($mediaResults) {
  # code...
  while ($rows =pg_fetch_array($mediaResults)) {

    $link = $rows['link'];
    $description = $rows['description'];
    $name = $rows['media_name'];
    $mediaid = $rows['mediaid'];
    $inBucketName = $rows['ext_name'];
    $imageFormates = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF");

    $pieces = explode(".", $inBucketName);
    if (in_array($pieces[1], $imageFormates)) {

      $Tag = "<img class='img-responsive'";
      $Close = ">";
      
    }else{
      $Tag = "<video controls> <source";
    $Close = "></video>";
    }


    $htmlTage = $htmlTage."<div class='col-md-3 mediaItems portfolio-item' id='$mediaid'>

      <div class='displayCheckBoxSpan'>
          <span class='input-group-addon' id='checkBoxDeleteSpan'>
            <input type='checkbox' name='checkboxmedia' class='chkbox' value ='$mediaid'>
          </span>
      </div>

      $Tag src='$link' $Close
           <h3>$name</h3>

      <div class='form-group saveButtonContainer'>
          <label for='comment'>Description:</label>
          <textarea disabled class='form-control textAreas' rows='2' name ='$mediaid' id='descriptionBox'>$description</textarea>
          <button type='button' class='btn btn-info' id ='$mediaid' onclick='descriptionBoxEdit(this.id)'>Edit</button>
      </div>
    </div>";
}
     
}else{
  $htmlTage = "No Data found";
}

return $htmlTage;

}

public function MediaSelectFucntion(){
  $htmltag = '';
$MediaSelect = pg_query("SELECT * from media order by mediaid ASC");
if ($MediaSelect) {
  # code...
        $htmltag=$htmltag."<option id='option' value=''>Choose</option>";
        while($rows = pg_fetch_array($MediaSelect)){
        $mediaid = $rows['mediaid'];
        $mediaName = $rows['media_name'];
        $htmltag=$htmltag."<option id='option' value='$mediaid'>$mediaName</option>";
    }
}
return $htmltag;
}

    public function getLocationManager(){
      $htmlTag = '';

      $locationsQuery2 = pg_query("SELECT * From location");

      if ($locationsQuery2) {
          $htmlTag ="<ul>";
          while($rows = pg_fetch_array($locationsQuery2)){
          $id = $rows['locationid'];
          $name = $rows['lname'];
           $htmlTag = $htmlTag."
          <li class='searcLocations' value='$id'>
            <input type='checkbox' name='checkboxlocation' class='chkbox locationManagerClass' value ='$id'/> 
            <p class='locationsName' ondblclick='dbClickEdit(this);'>$name</p>
            <input type='text' class='editManagerBox' onfocusout='fcEdit(this,$id);'style='display:none'/>
          </li>";

          }
           $htmlTag = $htmlTag."</ul>";
      }else{
        echo "noLocationsFound";
      }
          return $htmlTag;
    }

    public function getUsersAccounts(){
      $htmlTag = '';
      $username = $_SESSION['username'];
      $adminresults = pg_query("SELECT * From admin where username ='{$username}';");
      if($adminresults){
      if(pg_num_rows($adminresults)==1){
        $htmlTag = "<table style='width:auto'>
              <tr>
                <td><p>ACTIVE</p></td>
                <td style='padding-left:30px;''><p>USER NAME</p></td>
                <td style='padding-left:30px;'><p>REMOVE</p></td>
              </tr>";
      $results = pg_query("SELECT * FROM users LEFT  JOIN admin USING (userid) WHERE  admin.userid IS NULL;");
              while($rows = pg_fetch_array($results)){
                $userNameForm = $rows['email'];
                $active = $rows['active'];
                $userId = $rows['userid'];

                if($active==1){
                  $htmlTag = $htmlTag."<tr>
                <td><input type='checkbox' class='toggleSwitch' checked data-toggle='toggle' name='$userId' value='ON' onchange ='onToggleClick(this.value, this.name)' ></td>
                <td style='padding-left:30px;'><p>$userNameForm</p></td>
                <td style='padding-left:30px;'><button type='button' class='btn btn-default btn-sm' value='$userId' onclick='userAccountId(this.value)'>
                <span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td>
              </tr>";

                }else if($active==0){
                    $htmlTag = $htmlTag."<tr>
                <td><input type='checkbox' class='toggleSwitch' onchange='onToggleClick(this.value, this.name)' data-toggle='toggle' name='$userId' value='OFF' ></td>
                <td style='padding-left:30px;'><p>$userNameForm</p></td>
                <td style='padding-left:30px;'><button type='button' class='btn btn-default btn-sm' value='$userId' onclick='userAccountId(this.value)'>
                <span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td>
                </tr>";
                }

              }
              $htmlTag=$htmlTag.'</table>';

      }else{
      $htmlTag = "<h4> Admin Only</h4>";
    }
    }
      return $htmlTag;              
    }


    public function getNotesOfuser(){
      $htmltag = '';
      $username = $_SESSION['id'];
      $query = "SELECT * from notes where userid = $username order by mediaid DESC";
      $results = pg_query($query);

      if($results){
      while ($rows=pg_fetch_array($results)){
       $notesid = $rows['notesid'];
       $description = $rows['description'];
       
    $htmltag = $htmltag."<li value='$notesid'><textarea class='listItem'>$description</textarea><a id ='$notesid' class='removeListXbtn' style='display: none;' href='#'><button class='circleButtonX'>x</button></a> </li>";

    }

}else{

  $htmltag = 'Create new Note';

}

return $htmltag;

    }
      }


?>