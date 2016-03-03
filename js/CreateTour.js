$(document).ready(function() {
$("#createTourDialogueButton").click(function() {
var Tourid = $("#randomfield").val();
var tourname = $("#tourNameField").val();
var tourDate = $("#tourDateField").val();

if (Tourid == '' || tourname == '' || tourDate=='') {
alert("Insertion Failed, Some Fields are Blank");
} else {
$.post("database/Insertour.php", {
TourID: Tourid,
Tourname: tourname,
TourDate: tourDate,
}, function(data) {
alert(data);
//$('#form')[0].reset(); 
});
}
});
});