//$(function() {
//
//  // All elements
//  $('body').fontFlex(14, 20, 70);
//
//  // H1 only
//  $('h1').fontFlex(24, 36, 70); 
//
//});


$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><button><img class="imageButtons" img-block src="images/mriMachine.jpg" width="600px" align="left" ><p class="imgTextTop" align="left">Cardia</button><a href="gallery.html" class="remove_field">X</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});



//
//     <div class="span2">
//          <a style="text-decoration: none" href="gallery.html" class="pageButtons btn-default btn-lg btn-block">
//      		<span ><img class="imageButtons" img-block src="images/mriMachine.jpg" width="600px" align="left" ><p class="imgTextTop" align="left">Cardiac</p><p align="left" class="imgBottomText">North Wing</p>
//			</span> 
//		  </a>
//		 </div>