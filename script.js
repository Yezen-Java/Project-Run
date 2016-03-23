$(document).ready(function(){

  /*The create tour dialogue button creates and appends the details used
  to create a tour and add it to the SQL database, the physically see the
  tour, it will be appended to the bottom of the current tours div and when
  the user clicks this button which shows the tour name and code, the user 
  can then double click and change the name of the tour if necessary*/
  $("#createTourDialogueButton").click(function() {
    //variables for the tour ID (generated code), tour name and tour date, stored on SQL database.
    var Tourid = $("#randomfield").val();
    var tourname = $("#tourNameField").val();
    var tourDate = $("#tourDateField").val();

    //If the code is not generated or the tour name isn't filled or the date isn't selected, error notified.
    if (Tourid == '' || tourname == '' || tourDate=='') {
      createNoty('Insertion Failed, Some Fields are Blank', 'warning');
      hideNotification();
    } else {
      $.post("database/Insertour.php", {
        TourID: Tourid,
        Tourname: tourname,
        TourDate: tourDate,
      }, function(data) {
        if (data == false) {
          createNoty('Tourcode already exists', 'info');
          hideNotification();
         }else{
          createNoty('Tour created', 'success');
          hideNotification();
          $('#buttonsListTours').html(data);
          document.getElementById("randomfield").reset();
          document.getElementById("tourNameField").reset();
          document.getElementById("tourDateField").reset();
        }
      });
    }
  });

  $('.toggleSwitch').bootstrapToggle();

    $('#search').keyup(function(){
        var searchText = $(this).val();
        
        $('#myList > li').each(function(){
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;
            $(this).toggle(showCurrentLi);
        });     
    });

    $('.carousel').carousel('pause');

    $('.dropdown-menu').on("click",function(){  
      $(this).toggleClass('active');
    });

    $(".progress").addClass("hidden");
    $("#file_manager").addClass('hidden');
    
    $("#addTour").click(function(){
        $("#createTourDialogue").modal('show');
        randomStringGenerator();
    });

    $('#tourDateField').datepicker({
      format: "dd-mm-yyyy"
    });  

    $("#notes-toggle").click(function(e) {
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
           createNoty('Some of the files did not meet the requried formates,Please only upload jpg, png, gif, bmp,jpeg,PNG,JPG,JPEG,GIF,BMP,txt,mp4,mp3,m4v,avi,mpeg', 'warning');
           hideNotification();
      
          }else{
            console.log("Inside else.");
            refreshMediaList();
          $('#modalc').html(data);
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

    $('#EditlocationModel').on('hidden.bs.modal', function () {
      $('#EditlocationModel input').each(function(){
        console.log($(this));
        $(this).attr('checked', false);
        $(this).prop('checked', false);
      });
    });

    $('#EditlocationModel').on('show.bs.modal', function () {
      var selectedID = [];
      $(".previousLocations").each(function(index,obj){
        selectedID.push($(obj).attr('value'));
      });

      var checkboxes = document.getElementsByClassName('checkLocation');

      // loop over them all
      for (var i=0; i<checkboxes.length; i++) {
         // And stick the checked ones onto an array...
         if(selectedID.indexOf($(checkboxes[i]).attr('value')) > -1){
            console.log($(checkboxes[i]));
            $(checkboxes[i]).attr('checked', true);
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
      $(".progress").removeClass("hidden");
      $.ajax({
        url: "DeleteMedia.php",
        type: "POST",
        data: {items:array},
        success: function(data){
           if (data == false) {
            $(".progress").addClass("hidden");
            createNoty('Error, Try Again', 'warning');
            hideNotification();
          }else{
          $('#modalc').html(data);
          $(".progress").addClass("hidden"); 
                check = false;
                refreshMediaList();
        }
        },
        error: function(){}           
      });
    }
  });
});

//The location ID number is an auto generated value by the database, for each new location added to the system.
var LocationIdNumber ='';

/*The EditTourName method takes as parameters the value attribute of the 
tour selected, the new name we want to use to replace the current value
and we change the value of the editTourNameField with the new name.*/
function EditTourName(value,name){
  $('#editTourDialogue').modal('toggle');
  $('#editTourDialogue').attr("value",value);
  // console.log($('#editTourDialogue').attr('value'));
  $('#editTourNameField').val(name);
} 

// $(function() {
// $(".tourButtons").each(function(index,object){
//       $(object).on('dblclick', function (e) {
        
//       });
//     });
// });

/*The save function returns all the ID's of media uploaded including, videos, images and so forth
via the media manager, it then sends these files to the amazon s3 bucket, using SQL queries,
we can manipulate the files within the bucket.*/
function Save(){

var array = [];
 $('#listMedia div').each(function(i, li) {
  array.push($(li).attr('value'));
});
 //Console log all the names of data stored in the amazon s3 bucket.
for (var i = 0; i < array.length; i++) {
  console.log(array[i]);
};

      $(function() {
      var value1 = $('#tourButton').val();
       $.post('database/AddMediaToLocation.php',{items:array.join("::"), locationNo:LocationIdNumber}, function(data){
         if (data==true) {
          createNoty('Media Added', 'success');
          hideNotification();
         }else{
          createNoty('error, Please try Again', 'warning');
          hideNotification();
         }
       });
       return false;
  });

}


// if(window.File && window.FileReader && window.FileList && window.Blob){
//   alert('The file API works on this browser.')
// }else{
//   alert('The File API is is not fully supported in this browser.')
// }

// function myFunction() {
//   document.getElementById('notesArea').placeholder= Date();
// }

/*the reloaddiv method automatically reloads the mediaList container when called,
that way the user is presented with the current state of the media stored in the 
amazon s3 bucket. */
function reloaddiv(evt){
  $("#mediaList").load("index.php")
  evt.preventDefault();
}

function deleteTourLi(tourId){

  if (confirm("Confirm") == true) {
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
              createNoty('Tour deleted', 'success');
              hideNotification();
          }else{
            createNoty('Deleting tour failed', 'warning');
            hideNotification();
          }
          });
         }
    }
  }else{
    console.log("Tour was not deleted")
  }
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

function w3_open(value,name) {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
      var TourIdCode=value;
      TourCodeSelected = value;

      $(function() {
      var value1 = $('#tourButton').val();
       $.post('database/GetTourLocations.php',{value:TourIdCode}, function(data){

        var htmlTag ="<ul id='roomlist' name="+name+">"+data+"</ul>";
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

function addLocationRes(value,name,obj) {
  LocationIdNumber = value;
  var tourName = ($(obj).parent().attr('name'));
  $("#locationName").empty();
  $("#locationName").append("<h4>"+tourName+">"+name+"</h4>");

  $("#myModal ul").empty();
  $('#listMedia').sortable();
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
        createNoty('Locations have been added.', 'success');
        hideNotification();
        var addLocationsHtml = $("<a id="+selectedTourId+">"+selectedText+"</a>");
      $("#pointersDiv").append(addLocationsHtml);
       });
       return false;
  });
}

  

function appendMediaToLocaiton(value){
var locationID = value;
console.log("test "+locationID);
  $(function() {

       $.post('database/getmediaOfLocations.php',{LocationId:locationID}, function(data){
        $("#listMedia").append(data);
        $('#listMedia').sortable();
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
  if (selectedValue !== ""){
    $('#listMedia').append('<li class =tourLoactions> <button class="trashBoxMedia glyphicon glyphicon-trash"></button><a>'+selectedText+'</a><div class='+selectedValue+' value='+selectedValue+'></div> </li>');
    $('#listMedia ').sortable();
  }
  
}


function saveLocations(){

  var checked = getCheckedBoxes("checkboxlocation");
  // var unchecked = [];
  var array = [];
  for (var i = 0; i < checked.length; i++) {
    console.log("Checked "+checked[i]);
    array.push(checked[i]);
  }


var touridSelected = TourCodeSelected;

if(array !=null){
    $(function() {

       $.post('database/AddLocationClass.php',{TourID:touridSelected,items:array.join("::")}, function(data){
        if(data == true){
          createNoty('Locations added successfully', 'success');
          hideNotification();
          w3_open(touridSelected);
        }else{
          createNoty('Something went wrong', 'warning');
          hideNotification();
        }
       });
       return false;
  });

}else{
  createNoty('No locations were selected', 'info');
  hideNotification();
}


}

function TourEditName(){
    var tourid = $('#editTourDialogue').attr('value');
     var newTourName = $("#editTourNameField").val();
     $.post('database/ModifyTour.php',{TourID:tourid,newName:newTourName}, function(data){
        if(data == false){
          createNoty('Error', 'warning');
          hideNotification();
        }else{
            $('#buttonsListTours').html(data);
            createNoty('Tour saved', 'success');
            hideNotification();
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
        checkboxesChecked.push(checkboxes[i].value);
     }
  }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}

function deleteOnClick(){
 // var arrayofvalues = getCheckedBoxes('checkboxlocation');
var yourArray = []; 
  $("input:checkbox[name=checkboxlocation]:checked").each(function(){
    yourArray.push($(this).val());
});
  if (yourArray != null){

    $.post('database/DeleteLocation.php',{LocationIds:yourArray.join(".")}, function(data){
        if(data == false){
          createNoty('Error', 'warning');
          hideNotification();
        }else{
            $('#LocationManagerDiv').html(data);
          createNoty('Tours added successfully', 'success');
          hideNotification();
        }
       });
  }
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
            console.log(!v);
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
                    createNoty('Error', 'warning');
                    hideNotification();
                  }else{
                    createNoty('Success', 'success');
                    hideNotification();
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

     function dbClickEdit(obj){
          $(obj).hide().siblings(".editManagerBox").show().val($(obj).text()).focus();

     }

      function fcEdit(obj,id){
      console.log($(obj).val());
      console.log(id);
      var locationId = id;
      var NewLocationName = $(obj).val();
      $(obj).hide().siblings(".locationsName").show().text($(obj).val());
      $.post('database/EditLocationName.php',{LocationId:locationId,NewLocationName:NewLocationName}, function(data){
        console.log(data);
      if(data == false){
        createNoty('Error', 'warning');
        hideNotification();
      }else{
        console.log('Location Edit successfully');
      }
       });
      }

      function refreshMediaList(){
        
         $.post('database/RefreshMediaSelectList.php',{test:'test'}, function(data){
          var select = $('#MediaSelectId');
          select.empty().append(data);
        }); 
      }

      function deleteMediaLi(value){
        $.post('database/removeMediaOfLocation.php',{LocationId:LocationIdNumber, MediaId:value}, function(data){
              if(data==true){
                $(".trashBoxMedia").each(function(){
                  if($(this).attr("value") == value){
                    ($(this).parent()).remove();
                  }
                });
              }else{
                console.log('Error, function : deleteMediaLi');
              }
        }); 
      }

      function onToggleClick(value, name){
        console.log('name '+name+'value '+ value);
        var nameOfToggle = document.getElementsByName(name);
          if(value == "ON"){
            $(nameOfToggle).attr("value","OFF");
            console.log($(nameOfToggle).attr("value"));
            ManageUsers(name,0)
          }else{
            $(nameOfToggle).attr("value", "ON");
            console.log($(nameOfToggle).attr("value"));
            ManageUsers(name,1)
          }
      }

      function searchFiles(){
        var searchText = $('#searchFile').val();
        console.log(searchText);
        $('.mediaItems > h3').each(function(){

            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;
            
            ($(this).parent()).toggle(showCurrentLi);
        });       
      }

      function searchLoactions(){
        var searchText = $('#searchLoaction').val();
        console.log(searchText);
        $('.searcLocations > p').each(function(){

            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;
            
            ($(this).parent()).toggle(showCurrentLi);
        });       
      }

      function searchLocationEdit(){
        var searchText = $('#searchEditLocations').val();
        $('.editLoactionList label').each(function(){
            console.log($(this));
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;
            
            ($(this).parent()).toggle(showCurrentLi);
        });       
      }




      function ManageUsers(usernameid,number){
           $.post('database/ManageUsers.php',{Usernameid:usernameid,Number:number}, function(data){
              if(data==true){
                console.log('successfully, done');

              }else{
                console.log('Error');
              }
        }); 
      }

      function userAccountId(userId){

        if(userId != null && userId !=""){

           $.post('database/DeleteUser.php',{userId:userId}, function(data){
           if(data==false){
              console.log('error');
           }else{
                //$('#accountManagerModalCss').html(data);
                $(".userButtons").each(function(){
                  if($(this).attr('value') == userId){
                    (($(this).parent()).parent()).remove();
                  }
                });
           }
        }); 

        }

      }

    function createNoty(message, type) {
      var html = '<div class="alert alert-' + type + ' alert-dismissable page-alert">';    
      html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
      html += message;
      html += '</div>';    
      $(html).hide().prependTo('#noty-holder').slideDown();
    };

    function hideNotification(){
      setTimeout(function() {
        $('.page-alert').slideUp();
      }, 5000);
    }













     
