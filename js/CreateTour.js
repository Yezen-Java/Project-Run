$(document).ready(function() {
$("#createTourDialogueButton").click(function() {
var Tourid = $("#randomfield").val();
var tourname = $("#tourNameField").val();
var tourlevel = $("#tourLevelField").val();
var tourDate = $("#tourDateField").val();

if (Tourid == '' || tourname == '' || tourlevel == '' || tourDate=='') {
alert("Insertion Failed, Some Fields are Blank");
} else {
$.post("database/Insertour.php", {
TourID: Tourid,
Tourname: tourname,
Tlevel: tourlevel,
TourDate: tourDate,
}, function(data) {
alert(data);
//$('#form')[0].reset(); 
});
}
});
});