function addmedia(){

  var fileName = document.getElementById("file").value;

$(function() {

	alert("test");

           $.post('index.php',{ file:fileName }, function(data){
             $("#sortable").append(data);
           });
           return false;
      });
      

}