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






     
