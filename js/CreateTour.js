$(document).ready(function() {
$("#createTourDialogueButton").click(function() {
var Tourid = $("#randomfield").val();
var tourname = $("#tourNameField").val();
var tourlevel = $("#tourLevelField").val();
if (Tourid == '' || tourname == '' || tourlevel == '') {
alert("Insertion Failed, Some Fields are Blank");
} else {
$.post("Insertour.php", {
TourID: Tourid,
Tourname: tourname,
Tlevel: tourlevel
}, function(data) {
alert(data);
//$('#form')[0].reset(); 
});
}
});
});