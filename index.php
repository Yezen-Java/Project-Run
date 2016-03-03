<!DOCTYPE html>

<?php
//$dbconn = pg_connect("host=ec2-107-21-221-59.compute-1.amazonaws.com dbname=da2vmjb6giivfh user=enybctwamdyitl
 //password=z3paibkPjPYeWNWib9d3nD0Pi8")
 //or die('Could not connect: ' . pg_last_error());
//include 'imageChecker/image_check.php';
include 'database/Connect.php';


//require 'start.php';

error_reporting(E_ALL & ~E_NOTICE);
session_start();

if(isset($_SESSION['id'])){
    $userId= $_SESSION['id'];
    $username= $_SESSION['username'];

}else{
    header('location: login.php');
    die();
}


$toursListQuery = pg_query("SELECT * From Tour");

if ($toursListQuery) {
	echo "Tour query passed. ";
}else{
  	echo "Failed to Tour data. ";
}

if (isset($_POST['buttonR'])) {
  $TouridFromList = $_POST['tourSelector'];
  $NodesSelectQuery = pg_query("SELECT * From");
}


$locationsQuery = pg_query("SELECT * From location");

if ($locationsQuery) {

echo "Tour query passed. ";

}else{
  echo "Failed to Tour data. ";
}
//---------------------
// include('imageChecker/image_check.php');
// $msg='';
// if($_SERVER['REQUEST_METHOD'] == "POST")
// {

// $name = $_FILES['file']['name'];
// $size = $_FILES['file']['size'];
// $tmp = $_FILES['file']['tmp_name'];
// $ext = getExtension($name);

// if(strlen($name) > 0)
// {

// if(in_array($ext,$valid_formats))
// {
 
// if($size<(1024*1024))
// {
// include('config.php');
// //Rename image name. 
// $actual_image_name = time().".".$ext;
// if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
// {
// $msg = "S3 Upload Successful.";	
// $s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
// echo "<img src='$s3file' style='max-width:400px'/><br/>";
// echo '<b>S3 File URL:</b>'.$s3file;

// }
// else
// $msg = "S3 Upload Fail.";


// }
// else
// $msg = "Image size Max 1 MB";

// }
// else
// $msg = "Invalid file, please upload image file.";

// }
// else
// $msg = "Please select image file.";

// }

?>


<html lang="en">

<head>

    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script> 
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="shortcut icon" href="http://www.hongkiat.com/blog/favicon.ico">
    <link rel="icon" href="http://www.hongkiat.com/blog/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="global.css">
    <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=ABeeZee">
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA5UfBMd4ogo--f-j_ysGFxiQT2h2cJwnA"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.sidr/2.2.1/stylesheets/jquery.sidr.dark.min.css">
    <script src="js/CreateTour.js"></script>
    <script type="text/javascript" src="script.js"></script>

</head>

<body onload="myFunction()">

<!--The main Rapper that keeps the left nav bar, middle list of tours and right notes nav bar-->
<div id="wrapperLeft"> 

      <!--Below we have the left nav bar, this nav bar will contain the pointers the user creates for each
      tour, so when the user clicks a tour from the middle list, this left nav bar should appear with the
      tour pointer items, when the user clicks Delete or Add, the last item should disappear or a new item
      should be added to the end, currently we have only one item called "Link 1"-->
      <div id="leftBar">
        <nav class="w3-sidenav w3-white w3-card-2" style="display:none" id="leftBarId">
          <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large">Close &times;</a>
         <div id="pointersDiv">Locations</div>
          <div class="btn-group" role="group" aria-label="Basic example" id="buttonGroupPointer">
            <button id="addPointer" type="button" class="btn btn-success"><strong>Add</strong></button>
          </div>    
        </nav>
      </div>
      <!--Below we have a list-group which includes pre-made tours, we must add functionality to the Add 
      tour button so that when we click the button, a function should add a new button to the end of the
      list group-->
      <div class = "container" id="middleContainer">
        <div class="list-group" id="tourList">
          <ul id="buttonsListTours">
          	
           		<?php
              		while ($rows =pg_fetch_array($toursListQuery)) {
              		$tour_id =$rows["tourid"];
              		$tour_name =$rows["tour_name"];

           			echo "<li id='$tour_id'> 
           					<div class='input-group'> <span class='input-group-addon'> <input type='checkbox' aria-label='...'> </span><button type='button' id='tourButton' class='list-group-item' value='$tour_id' onclick='w3_open(this.value)'>$tour_name $tour_id</button> </div> </li>";
              		}  
              	?>
          
          </ul>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example" id="tourButtonGroup">
          <button id="deleteTour" type="button" class="btn btn-danger"><strong>Delete</strong></button>
          <button id="addTour" type="button" class="btn btn-success" data-toggle="modal" data-target="#createTourDialogue"><strong>Add</strong></button>
        </div>
      </div>
      
    <!--Below we have the notes nav bar wrapped, here we should be able to add new notes, delete notes and
    so forth.-->
    
    <div id="wrapper">
        <div id="sidebar-wrapper">
          <ul class="sidebar-nav" id="sideBar">  
                <li class="sidebar-brand" style="padding-top:10px;">
                  <div id="container">
                    <form name="form1" method="post" action="">
                      <input type="text" name="toDoTextArea" id="toDoTextArea" autofocus>
                      <button type="button" class="btn-success" name="addBtn" id="addBtn" autofocus>Add</button>
                    </form>
                    <ul id="myList" class="sortable list"></ul>
                    <button class="btn btn-danger" id="btnClear"><a id="clearAll" href="javascript:void();">Delete All</a></button>
                  </div>
                </li>
          </ul>
        </div>
    </div>
</div>

<div class="container">
  <nav class="navbar navbar-default navbar-fixed-top" id="topNavbarDefault">
    <div class="container">
      <div class="navbar-header" id="topNavbar">
      	<div class=".col-md-9" id="topNavbarContainer">
        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          		<span class="sr-only">Toggle navigation</span>
          		<span class="icon-bar"></span>
          		<span class="icon-bar"></span>
          		<span class="icon-bar"></span>
        	</button>
      	</div>
      	<div class=".col-md-3" id="bottomNavbarContainer">
      		<a class="navbar-brand"><strong>Hive</strong> Dashboard</a> 
      	</div>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="#" id="menu-toggle">Note</a></li>
          <li><a href="#" id="generateCode" onclick="randomStringGenerator();">Generate Code</a></li>
          <li id="codeGenerateCssLi"><input type="text" class="form-control" placeholder="Code" id="randomfield" readonly="readonly"></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  </div>

  <div class="container">
  <!--Create tour dialogue box-->
  <div class="modal fade" id="createTourDialogue" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Tour</h4>
        </div>

        <div class="modal-body" id="tourTextFields">
          <input type="text" class="form-control" id="tourNameField" placeholder="Name of tour" value="" >
          <input type="text" class="form-control" id="tourDateField" placeholder="Date">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="createTourDetails();" 
          id="createTourDialogueButton" >Create</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--Create tour dialogue box-->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">

          <h4>Or drag and drop files below</h4>
            <div class="upload-drop-zone" id="drop-zone">
              Just drag and drop files here
            </div>

          <script src="jquery.sortable.js"></script>

            <ul class="sortable">
              <li> item1
            </ul>

        </div>
        <div class="modal-footer">
          <button type ="button" class="btn btn-default" onclick = "Save()">Save</button>
          <form action="" method='post' enctype="multipart/form-data">
          <input type ="file" name ="file1" value="Show Dialog">
          <input type="submit" vlaue= "UploadFile">
          </form>
          <button type ="button" class="btn btn-default" onclick = "DeleteCircle()">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

</body>
<script src="myJquery.js"></script>
<script>
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

$("#pointer1").click(function(){
  $("#myModal ul").empty();
  console.log("works");
    reorder();
    $("#myModal").modal();
    $('.sortable').sortable();
});

function Save(){

var array = [];
$('.sortable li').each(function(i, li) {
  array.push($(li));
});
for (var i = 0; i < array.length; i++) {
  console.log(array[i].text() + i);
};

}

var files = [
  {
    name: "file1",
    order: 1
  },

  {
    name: "file2",
    order: 0
  },

  {
    name: "file3",
    order: 2
  }
];

function compare(a,b) {
  if (a.order < b.order)
    return -1;
  else if (a.order > b.order)
    return 1;
  else 
    return 0;
}

function reorder(){
  files.sort(compare);
  console.table(files);
  for (var i = 0; i < files.length; i++) 
  {
      $(".sortable").append("<li>" +files[i].name);
  }
}
</script>

</html>