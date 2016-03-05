$(document).ready(function(){
    $("#addTour").click(function(){
        console.log("button");
        $("#createTourDialogue").modal('show');
    });
});

$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

$("#pointer1").click(function(){
  reorder();
  $("#myModal").modal('show');
  $('.sortable').sortable();
});

var files = [
  {
    name: "file1",
    order: 2
  },
  
  {
    name: "file2",
    order: 1  
  },
  
  {
    name: "file3",
    order: 3
  }
];

function compare (a,b){
  if(a.order < b.order)
    return -1;
  else if (a.order > b.order)
    return 1;
  else
    return 0;
}

function reorder(){
  files.sort(compare);
  console.table(files);

  for (var i = 0; i < files.length;i++){
    console.log(files[i].name);
    $("#myModal ul").append("<li>" +files[i].name);
  }
}


function Save(){

var array = [];
$('.sortable li').each(function(i, li) {
  array.push($(li));
});
for (var i = 0; i < array.length; i++) {
  console.log(array[i].text() + i);
};

}


if(window.File && window.FileReader && window.FileList && window.Blob){
  alert('The file API works on this browser.')
}else{
  alert('The File API is is not fully supported in this browser.')
}

function myFunction() {
  document.getElementById('notesArea').placeholder= Date();
}

function deleteTourLi(value){
  $(value).remove();
}

function addNoteFunc(){
    myFunction();
    ul = $('#sideBar');
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


function addmedia(){

  var fileName = document.getElementById("file").value;

$(function() {

           $.post('lib/amazon/S3UploadFunction.php',{ file:fileName }, function(data){
             $("#sortable").append(data);
           });
           return false;
      });
      

}
    












     
