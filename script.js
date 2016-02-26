$(document).ready();
$("#EditTourButton").click(function(){
  console.log($("#myModal ul").sortable('toArray'));
});

   
var myCity = new google.maps.Circle({
  center: LONG,LAT,
  radius:20000,
  strokeColor:"#0000FF",
  strokeOpacity:0.8,
  strokeWeight:2,
  fillColor:"#0000FF",
  fillOpacity:0.4
});

$("#theCarousel").carousel();

$("#createAccountButton").onClick(function(){
  $("#theCarousel").carousel("prev");
});

if(window.File && window.FileReader && window.FileList && window.Blob){
  alert('The file API works on this browser.')
}else{
  alert('The File API is is not fully supported in this browser.')
}

    var dropZone = document.getElementById('drop-zone');
    var uploadForm = document.getElementById('js-upload-form');

    var startUpload = function(files) {
        console.log(files);
    };

    uploadForm.addEventListener('submit', function(e) {
        var uploadFiles = document.getElementById('js-upload-files').files;
        e.preventDefault();

        startUpload(uploadFiles);
    });

    dropZone.ondrop = function(e) {
        e.preventDefault();
        this.className = 'upload-drop-zone';

        startUpload(e.dataTransfer.files);
    };

    dropZone.ondragover = function() {
        this.className = 'upload-drop-zone drop';
        return false;
    };

    dropZone.ondragleave = function() {
        this.className = 'upload-drop-zone';
        return false;
    };

    
 function myFunction() {
        document.getElementById('notesArea').placeholder= Date();
    }

    function addNoteFunc(){
        myFunction();
        ul = $('#sideBar');
        ul.find('li:first').clone(true).appendTo(ul);
    }
    function createTour(){
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

    function w3_open(value) {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
          var TourIdCode=value;

          $(function() {
          var value1 = $('#tourButton').val();
           $.post('database/GetTourLocations.php',{value:TourIdCode}, function(data){
             $("#pointersDiv").html(data);
           });
           return false;
      });
      

    }

    function w3_close() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
    }
    
    function createInput(){
      ul = $('#buttonsListTours');
      ul.find('li:first').clone(true).appendTo(ul);
    }

    function createTour(tourNameVar){
        var $input = $("<button type="+"button"+" class="+"list-group-item"+" id="+"tourOne"+" onclick="+"w3_open()"+">"+tourNameVar+"</button>");
        toursArray.push($input);
        $input.appendTo($("#buttonsListTours"));
    }

    /* createTourDialogueButton onclick method,
    we should take the values inserted into the three text area's 
    and append this value i.e. tour name to the tourOne button text*/

    function createTourDetails(){
      var tourName = document.getElementById("tourNameField").value;
      //var tourFloor = document.getElementById("tourLevelField").value;
      //var tourName = document.getElementById("tourDateField").value;
      createTour(tourName);
    }
//this function open the file model for specific locations.
    function addLocationRes(value) {
  $("#myModal ul").empty();
  console.log("works");
    reorder();
    $("#myModal").modal();
    $('.sortable').sortable();

    }
    












     
