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
	 alert('Tour Code MayBe alredy exsits');
	 }else{
	 alert('Tour Created');
	$('#buttonsListTours').html(data);
	document.getElementById("randomfield").reset();
	document.getElementById("tourNameField").reset();
	document.getElementById("tourDateField").reset();
}
});
}
});
});