$(document).ready(function(){
    $("#search").keypress(function(e){
      console.log($("#search").val());
      
      $("#myList").each(function(index,object){
        console.log($(object));
      
      });

      
    });
    $(".progress").addClass("hidden");
    $("#file_manager").addClass('hidden');
    $("#addTour").click(function(){
        $("#createTourDialogue").modal('show');
    });

    $(".tourButtons").each(function(index,object){
      $(object).dblclick(function () {
        $('#editTourDialogue').modal('toggle');
        $('#editTourDialogue').attr("value",$(object).attr("value"));
        // console.log($('#editTourDialogue').attr('value'));
        $('#editTourNameField').val($(object).attr("name"));
      });
    });

    $('#tourDateField').datepicker({
      format: "dd-mm-yyyy"
    });  

    $("#menu-toggle").click(function(e) {
      console.log("button");
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $("#fileMangerNav").click(function(){
        console.log("clicked");
        $("#middleContainer").empty("#tourList");
        $("#file_manager").removeClass('hidden');
        $("#middleContainer").add("#file_manager");
    });

    $("#uploadForm").on('submit',(function(e){
      e.preventDefault();

      $(".progress").removeClass("hidden");

      $.ajax({
        url: "UploadScript.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){

          if (data == false) {
            $(".progress").addClass("hidden");
            alert("Some of the files did not meet the requried formates,Please only upload jpg, png, gif, bmp,jpeg,PNG,JPG,JPEG,GIF,BMP,txt,mp4,mp3,m4v,avi,mpeg");
          }else{
          $('#modalc').append(data);

          $(".progress").addClass("hidden");
          
        }
        },
        error: function(){}           
      });
    }));

    // $("#deleteImage").on('submit',(function(e){
    //   e.preventDefault();
    //   $.ajax({
    //     url: "DeleteMedia.php",
    //     type: "POST",
    //     data: new FormData(this),
    //     contentType: false,
    //     cache: false,
    //     processData:false,
    //     success: function(data){

    //       alert(data);
    //     },
    //     error: function(){}           
    //   });
    // }));

    $('#locationManagerModel').on('show.bs.modal', function () {

  // $getLocations =  $getLocations."<a href ='#'id ='pointer1' value ='$locationId' onclick='addLocationRes($locationId)'>$locationname</a>
  // <button type='button' value ='$locationId' class='btn btn-default btn-sm'>
  //           <span class='glyphicon glyphicon-trash'></span> Trash 
  //         </button>";
  //     }
    
      var selectedID = [];
      $(".previousLocations").each(function(index,obj){
        selectedID.push($(obj).attr('value'));
      });

      console.log(selectedID);

      var checkboxes = document.getElementsByName('checkboxlocation');
      // loop over them all
      for (var i=0; i<checkboxes.length; i++) {
         // And stick the checked ones onto an array...
         if(selectedID.indexOf($(checkboxes[i]).attr('value')) > 0){
            $(checkboxes[i]).prop('checked', true);
         }
      }
    }); 

    var check = false;

  $("#deleteCheckedItems").click(function(){
    var arrayofvalues = [];
    $('.chkbox:checked').each(function() {
            arrayofvalues.push($(this).val());
        });
    console.log(arrayofvalues);
    if (check == false){
      $(".displayCheckBoxSpan").show("slow");
      check = true;
      return;
    }else if (check == true && arrayofvalues == null){
      $(".displayCheckBoxSpan").hide("slow");
      check = false;
      return;
    } else {
      // for (var i = 0; i < array.length; i++) {
      //   Arrayofvlaues.push(array[i].val());
      //   console.log(array[i].val());
      // }
      var array = arrayofvalues.join("::");
      console.log(array);
      $.ajax({
        url: "DeleteMedia.php",
        type: "POST",
        data: {items:array},
        success: function(data){
          alert(data);
        },
        error: function(){}           
      });
    }
  });
});

// $("#file-manager").click(function(){
//         $("#file_manager_dialogue").modal('show');
//     });


$("#pointer1").click(function(){
  reorder();
  $("#myModal").modal('show');
  $('.sortable').sortable();
});

// var files = [
//   {
//     name: "file1",
//     order: 2
//   },
  
//   {
//     name: "file2",
//     order: 1  
//   },
  
//   {
//     name: "file3",
//     order: 3
//   }
// ];

function compare (a,b){
  if(a.order < b.order)
    return -1;
  else if (a.order > b.order)
    return 1;
  else
    return 0;
}

// function reorder(){
//   //files.sort(compare);
//  // console.table(files);

//   for (var i = 0; i < files.length;i++){
//     console.log(files[i].name);
//     $("#myModal ul").append("<li>" +files[i].name);
//   }
// }

var LocationIdNumber ='';

function Save(){

var array = [];
 $('.sortable li').each(function(i, li) {
  array.push($(li).attr('value'));
});
for (var i = 0; i < array.length; i++) {
  console.log(array[i]+ i);
};

      $(function() {
      var value1 = $('#tourButton').val();
       $.post('database/AddMediaToLocation.php',{items:array.join("::"), locationNo:LocationIdNumber}, function(data){
         if (data==true) {
          alert("Media Added");
         }else{
          alert("error, Please try Again");
         }
       });
       return false;
  });





}


if(window.File && window.FileReader && window.FileList && window.Blob){
  alert('The file API works on this browser.')
}else{
  alert('The File API is is not fully supported in this browser.')
}

function myFunction() {
  document.getElementById('notesArea').placeholder= Date();
}

function reloaddiv(evt){

         $("#mediaList").load("index.php")
         evt.preventDefault();
     
}

function deleteTourLi(tourId){
    var list = document.getElementById("buttonsListTours");
    var size = $("#buttonsListTours li").length;
    console.log(size);
    for (var x = 0; x < size; x++) {
        var item = $('#buttonsListTours').children('li').get(x);
        console.log(item);
        console.log(item.id);
         if(item.id == tourId){
          item.remove();
          $.post('database/DeleteTours.php',{TourID:tourId}, function(data){
            if (data==true) {
              alert("TourDeleted");
          }else{
            alert("Deleteing tour falid");
          }
          });
 

         }
    }
      // $(".tourButtons").get(i).remove();
      // $(this).remove();
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

var TourCodeSelected ="";

function w3_open(value) {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
      var TourIdCode=value;
      TourCodeSelected = value;

      $(function() {
      var value1 = $('#tourButton').val();
       $.post('database/GetTourLocations.php',{value:TourIdCode}, function(data){

        var htmlTag ="<ul id="+"roomlist"+">"+data+"</ul>";
         $("#pointersDiv").html(htmlTag);
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
   LocationIdNumber = value;
  console.log("test value "+ value);
  $("#myModal ul").empty();
  console.log("works");
 // reorder();
  $("#myModal").modal();
  $('.sortable').sortable();

  appendMediaToLocaiton(value);
}


function addLocations(){
var  selectedTourId = TourCodeSelected;
var selectList = $('#selectLocation').val();
var skillsSelect = document.getElementById("selectLocation");
var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text;

      console.log(selectedTourId);
      console.log(selectList);
      console.log(selectedText);

 $(function() {
       $.post('database/addLocationScript.php',{TourID:selectedTourId,LocationID:selectList}, function(data){
        alert(data);
        var addLocationsHtml = $("<a id="+selectedTourId+">"+selectedText+"</a>");
      $("#pointersDiv").append(addLocationsHtml);
       });
       return false;
  });


}

  

function appendMediaToLocaiton(value){
var locationID = value;
console.log("test "+locationID)
  $(function() {

       $.post('database/getmediaOfLocations.php',{LocationId:locationID}, function(data){
        $("#listMedia").append(data);
        //$('.sortable').sortable();
       });
       return false;
  });
}


function addmeidaFromSelectList(){

   var selectBox = document.getElementById("MediaSelectId");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var selectedText = selectBox.options[selectBox.selectedIndex].text;

    console.log(selectedValue);
    console.log(selectedText);

    $('#listMedia').append('<li value='+selectedValue+'> <button class="glyphicon glyphicon-trash" id="trashBoxMedia"></button> <a>'+selectedText+'</a> </li>');
    $('.sortable').sortable();


}


function saveLocations(){

  var checked = getCheckedBoxes("checkboxlocation");
  // var unchecked = [];
  var array = [];
  for (var i = 0; i < checked.length; i++) {
    console.log("Checked "+checked[i].value);
    array.push(checked[i].value);
  }


var touridSelected = TourCodeSelected;

    $(function() {

       $.post('database/AddLocationClass.php',{TourID:touridSelected,items:array.join("::")}, function(data){
        if(data == true){
          alert("locations Added successfully");
          w3_open(touridSelected);
        }else{
          alert("SomeThing went wrong");
        }
       });
       return false;
  });

}

function TourEditName(){
  //\\\\\\\\\\\\\\\
    var tourid = $('#editTourDialogue').attr('value');
     var newTourName = $("#editTourNameField").val();
     $.post('database/ModifyTour.php',{TourID:tourid,newName:newTourName}, function(data){
        if(data == false){
          alert("error");
        }else{
            $('#buttonsListTours').html(data);
        }
       });
} 


function getCheckedBoxes(element) {
  var checkboxes = document.getElementsByName(element);
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i]);
     }
  }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}

/*
    The descriptionBoxEdit method is meant to find the unique descriptionBox and when the user clicks the Test button
    it should automatically make that specific text area readonly - by Sedar 
    */
    function descriptionBoxEdit(idOfDescriptionBox){
      var currentValue = null; 
      $(".textAreas").each(function(i,obj){
        if($(obj).attr('name') == idOfDescriptionBox){
          currentValue = $(obj).attr('name');
          $(obj).prop('disabled', function(i,v) {
            return !v;
          });
          var descriptionText = $(obj).val();
          $("button").each(function(i,bobj){
            if ($(bobj).attr('id') == currentValue ) {
              console.log(descriptionText);
              if($(bobj).text() == "Save" && descriptionText != ""){
                $(bobj).text("Edit");
                $.post('database/AddMediaDescription.php',{Mediaid:$(bobj).attr('id'),Description:descriptionText}, function(data){
                  if(data == false){
                    alert("error");
                  }else{
                    alert("works");
                  }
                }); 
              } else {
                $(bobj).text("Save");
              }
            }
          });
        }
      });
    }







     
