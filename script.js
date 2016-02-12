
$(document).ready();
$("#EditTourButton").click(function(){
  window.location = "https://www.google.com/maps/d/edit?mid=zdaGz_kxHGcY.kNA-vyp_PChI&usp=sharing" + this.id;
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
     