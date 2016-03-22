<?php

error_reporting(E_ALL & ~E_NOTICE);
session_start();

if(isset($_SESSION['id'])){
    $userId= $_SESSION['id'];
    $username= $_SESSION['username'];
}else{
    header('location: login.php');
    die();
}
include 'database/Connect.php';
include 'database/LoadDataOnstart.php';


$LoadOnStart = new LoadOnStart();


?>
<!DOCTYPE html>

<html lang="en">

<head>
        <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="jquery.editable.js"></script>
    <script src="datepicker.js"></script>
    <script type="text/javascript" src="jquery.form.min.js"></script>

    <!--CSS LINK-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="datepicker.css">
    <!--JS LINK-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   
    <!--QUnit testing LINK-->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-1.22.0.css">
    <script src="//code.jquery.com/qunit/qunit-1.14.0.js"></script>

    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="myJquery.js"></script>
    <script src="jquery.sortable.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="js/CreateTour.js"></script>
    <script src="tests.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script type="text/javascript" src="script.js"></script>
    
</head>

<body onload="myFunction()">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" style="color:#ecf0f1;" href="#"><strong>Hive</strong> Dashboard</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#" style="color:#ecf0f1;">Home</a></li>
        <li><a href="#" style="color:#ecf0f1;" id="notes-toggle">Note</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" style="color:#ecf0f1;" data-toggle="dropdown" href="#">Manager  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#file_manager_dialogue" id="file-manager" style="color:#2c3e50;" data-toggle="modal">File Manager</a></li>
            <li><a href="#LocationMangerModal" id="location-manager" style="color:#2c3e50;" data-toggle="modal">Location Manager</a></li>
            <li><a href="#account-manager-modal" id="account-manager" style="color:#2c3e50;" data-toggle="modal">Account Manager</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#logoutModal" data-toggle="modal" style="color:#ecf0f1;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--The main Rapper that keeps the left nav bar, middle list of tours and right notes nav bar-->
<div id="wrapperLeft"> 
      <!--Below we have the left nav bar, this nav bar will contain the pointers the user creates for each
      tour, so when the user clicks a tour from the middle list, this left nav bar should appear with the
      tour pointer items, when the user clicks Delete or Add, the last item should disappear or a new item
      should be added to the end, currently we have only one item called "Link 1"-->
      <div id="leftBar">
        <nav class="w3-sidenav w3-card-2 w3-light-grey" id="leftBarId">
          <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large">Close &times;</a>
          <div class="container" id="leftBarButtonsContainer">
            <div id="pointersDiv">Locations</div>
          </div>
          <div class="container" id="leftbarContainerManage">
            <button id="addPointer" type="button" class="btn btn-success" data-toggle="modal" href="#EditlocationModel"><strong>Manage</strong></button>
          </div>
        </nav>
      </div>
      <!--Below we have a list-group which includes pre-made tours, we must add functionality to the Add 
      tour button so that when we click the button, a function should add a new button to the end of the
      list group-->
      <div id="middleContainer" class="container">
        <div class="list-group" id="tourList">
          <ul id="buttonsListTours">  
          <?php
            echo $LoadOnStart->getTourList();
          ?>
          </ul>
          </div>  
        <div class="btn-group" role="group" aria-label="Basic example" id="tourButtonGroup">
          <button id="addTour" type="button" class="btn btn-success"><strong>Add</strong></button>
        </div>
      </div>

    <!--Below we have the notes nav bar wrapped, here we should be able to add new notes, delete notes and
    so forth.-->
    
    <div id="wrapper">
        <div id="sidebar-wrapper">
          <ul class="sidebar-nav" id="sideBar">  
                <li class="sidebar-brand" style="padding-top:10px;">
                  <div id="container">
                    <form name="form1" id="notesBarHeight" method="post" action="">
                      <input type="text" class="form-control" id="search" placeholder ="Search"> 
                        <div class="input-group" id="notesBarItemsTop">
                          <input type="text" class="form-control" placeholder="Message" id="toDoTextArea">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" id="addBtn">Add</button>
                            </span>
                        </div>
                    </form>
                    
                    <div class="container" id="buttonContainer">
                      <button class="btn btn-danger" id="clearAll"><a href="javascript:void();" id="clearAll">Delete All</a></button>
                    </div>
                    
                  </div>
                </li>
                <div class="container" id="leftNotesCont">
          <ul id="myList" class="sortable list searching"></ul>
        </div>
          </ul>
        </div>
    </div>
</div>
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
            <div class="hero-unit">
                <input type="text" class="form-control" id="tourDateField" placeholder="click to show datepicker">
            </div>
          <input type="text" class="form-control" placeholder="Code" id="randomfield" readonly="readonly">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="createTourDetails();" 
          id="createTourDialogueButton" >Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--Create tour dialogue box-->

  
  <div class="modal fade" id="file_manager_dialogue" role="dialog">
    <div class="modal-dialog" id="fileContent">
      <div class="modal-content" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">File Manager</h4>
        </div>
            
        <div id= "fileManagerDiv" class="modal-body">
          <div class="container col-md-12">
            <div class="row">
              <div class=".col-sm-8">
                <input type="text" class="form-control" id="searchFile" onkeyup="searchFiles()" placeholder ="Search">
              </div>
            </div>
          </div>
          <div class = "list-group" id="modalc">
            <?php  
             echo $LoadOnStart->mediaResultsFucntion();
            ?>
          </div>
        </div>

        <div class="modal-footer">
          <div class="progress">
            <div class="progress-bar progress-bar-striped active" id="progressBar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" width ="40px"style="width:100%">
          </div>
        </div>
             
        <form id = 'uploadForm' action="" method="post" enctype="multipart/form-data">
          <div style='margin:10px'><input type='file' name='file[]' multiple=""/> 
            <button type="button" class="btn btn-warning" id="deleteCheckedItems">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type ="submit" class="btn btn-default" value='Upload Image'/>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div> 
  <!--File manager dialogue box-->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="mediaList" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title" id="locationName">
          </div>
          <select id="MediaSelectId" class="form-control" onchange="addmeidaFromSelectList()">
          <?php
          echo $LoadOnStart -> MediaSelectFucntion();
          ?>
          </select>
        </div>
      <div class="modal-body">
      <h1>Uploaded Files</h1>
          <ul id ="listMedia">
          </ul>
      </div>
        <div class="modal-footer">

          <button type ="button" class="btn btn-default" onclick = "Save()">Save</button>
          <button type ="button" class="btn btn-default" onclick = "DeleteCircle()">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    <!--EditTourDialogue-->
  <div class="modal fade" id="editTourDialogue" role="dialog" value="">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Tour</h4>
        </div>

        <div class="modal-body" id="tourTextFields">
          <input type="text" class="form-control" id="editTourNameField" placeholder="Name of tour" value="" >
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick = "TourEditName()">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!--End of edit tour dialogue-->

  <!--Account Manager Modal-->
  <div class="modal fade" id="account-manager-modal" role="dialog" value="">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Account Manager</h4>
        </div>
        <div class="modal-body" id="modifyAccountBody">
          <div class="container" id="accountManagerModalCss">
          <!-- The table contains two rows, these are the "access all features" switches
          within the modal that contain all user account names, the admin account can
          enter this modal and grant administritive privilages. 
          -->
            <table style="width:auto">
              <tr>
                <td><p>ACTIVE</p></td>
                <td style="padding-left:30px;"><p>USER NAME</p></td>
                <td style="padding-left:30px;"><p>REMOVE</p></td>
              </tr>
              <?php 
            echo $LoadOnStart->getUsersAccounts();
          ?>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--End of account manager modal-->

<div class="modal fade" id="EditlocationModel" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Locations</h4>
        </div>
      <div class="modal-body">
      <h1>Edit Locations</h1>
      <?php 
        $LoadOnStart->getLocationList();
      ?>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="saveLocations()">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="LocationMangerModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Locations</h4>
             <h1>Edit Locations</h1>
        </div>
      <div id ="LocationManagerDiv" class="modal-body">
      <div>      
        <input type="text" class="form-control" id="searchLoaction" onkeyup="searchLoactions()" placeholder ="Search">
      </div>

      <?php 
     echo $LoadOnStart->getLocationManager();
          ?>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="deleteOnClick();">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal bs-example-modal-sm" id="logoutModal"tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
      <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
      <div class="modal-footer">
      <form action="database/logout.php" method="post">
      <input type="submit" value="Logout" class="btn btn-primary btn-block"/>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>