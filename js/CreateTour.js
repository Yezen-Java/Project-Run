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

	if (data == false) {
		alert('Error, Try again');
	}else{
		alert('Tour Created');
	$('#buttonsListTours').html(data);
}
});
}
});
});