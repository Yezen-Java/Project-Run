<?php
$dbconn = pg_connect("host=ec2-107-21-221-59.compute-1.amazonaws.com dbname=da2vmjb6giivfh user=enybctwamdyitl
 password=z3paibkPjPYeWNWib9d3nD0Pi8")
or die('Could not connect: ' . pg_last_error());

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


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script> 
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA5UfBMd4ogo--f-j_ysGFxiQT2h2cJwnA"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script
        src="https://www.google.com/maps/d/embed?mid=zdaGz_kxHGcY.kNA-vyp_PChI">
    </script>



    <script>
    var whichCircle;
    var map;
    var myCenter=new google.maps.LatLng(51.48963307250382, -0.1708325743675232);
    var circles = [];
    var uniqueId = 0;
    function initialize(){
    var mapProp = {
      center:myCenter,
      zoom:18,
      mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
      google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
        var location = event.latLng;
      });
    }
    function placeMarker(location) {
        var circle = new google.maps.Circle({
            center:location,
            map:map,
            position:location,
            radius:10,
            strokeColor:"#0000FF",
            strokeOpacity:0.8,
            strokeWeight:2,
            fillColor:"#0000FF",
            fillOpacity:0.4
        });
        circle.id = uniqueId;
        uniqueId++;
  
    google.maps.event.addListener(circle, "click", function (e){
        whichCircle = circle.id;
        $("#myModal").modal();
      });

    circles.push(circle);



    document.getElementById("search_results").innerHTML = circles;

      
    } 
    function DeleteCircle(){
        for (var i = 0; i < circles.length; i++){
            if (circles[i].id == whichCircle){
                circles[i].setMap(null);
                circles.splice(i, uniqueId);
                $('#myModal').modal('hide');
              document.getElementById("search_results").innerHTML = circles;

                return;
            }
        }
    };

  $(function() {
    $( "#sortable" ).sortable();
  });

    function myFunction() {
        document.getElementById('notesArea').placeholder= Date();
    }

    function addNoteFunc(){
        myFunction();
        var ul = $('#sideBar');
        ul.find('li:first').clone(true).appendTo(ul);
    }

    function randomStringGenerator() {
      var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZ";
      var string_length = 6;
      var randomstring = '';
      for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
      }
      document.getElementById("randomfield").value = randomstring;
    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>

<script>
$(function() {
        $("#lets_search").bind('submit',function() {
        	var select = document.getElementById("tourSelector1");
            var answer = select.options[select.selectedIndex].value;
           $.post('database/TourLocationQuery.php',{TourCode:answer}, function(data){
             $("#search_results").html(data);
           });
           return false;
        });
      });


function (){


}

</script>

</head>

<body onload="myFunction()">
  <div id="wrapper" class="">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav" id="sideBar">

        <button type="button" class="btn btn-success" id="addNoteButton" onclick="addNoteFunc()">+</button>
            <li class="sidebar-brand" style="padding-top:10px;">
                <textarea class="form-control" rows="5" id="notesArea" type="text"></textarea>
            </li>
        </ul>
    </div>
  </div>

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand">Project name</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a>Home</a></li>
          <li><a href="#" id="EditTourButton">Edit Tour</a></li>
          <li><a href="#" id="menu-toggle">Note</a></li>
          <li><a href="#" id="generateCode" onclick="randomStringGenerator();">Generate Code</a></li>
          <li id="codeGenerateCssLi"><input type="text" class="form-control" placeholder="Code" id="randomfield" readonly="readonly"></li>
          <li></li>
          <li> <select class="form-control" id="tourSelector1" name="tourSelector">
        <option vlaue= "chose">Edit A Tour</option>
            <?php
            
            while ($rows =pg_fetch_array($toursListQuery)) {
            $tour_id =$rows["tourgode"];
            $tour_name =$rows["tour_name"];

                echo "<option value='$tour_id'>
                $tour_name
              </option>";
            
            }
                
            ?>
            </select></li>

            <li><form id="lets_search" action=""> <input class="btn btn-default" name="buttonR" type="submit"></input>
            </form>
            </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div id="page-content-wrapper">
    <div id="googleMap"></div>
    <input id="myInput" type="file" style="visibility:hidden"/>
  </div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
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
            <li>Item 1
            <li>Item 2
            <li>Item 3
            <li>Item 4
          </ul>

          <script>
            $('.sortable').sortable();
          </script>


        </div>
        <div class="modal-footer">
        <button type ='button' value="Show Dialog" class="btn btn-default" onclick="$('#myInput').click();">Upload</button>
          <button type ='button' class="btn btn-default" onclick = "DeleteCircle()">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<div id="show">
</div>
<div id = "search_results">Testing</div>
</body>
    <script type="text/javascript" src="script.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</html>