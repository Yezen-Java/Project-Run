	  $(document).ready(function() {
	//holds code for new list item
	var newListItem;
		  //wether we have a list or not
	var newNotesList = true;
		  //Getting the list objects
	var myList = document.getElementById('myList');

	$('#addBtn').on('click', function(e) {
		e.preventDefault();
		//check wether this is the first time a new list is being added
		if (newNotesList == true) {
			var valueFromInput = $("#toDoTextArea").val();			
			//handle is used to move the list items ie dragging 
			newListItem = 
		'<li><textarea class="listItem"> '+  valueFromInput +'</textarea><a class="removeListXbtn" style="display: none;" href="#"><button class="circleButtonX">x</button></a> </li>'//a link to remove the items ie the x button; button;
			newNotesList = true;
			  $.post('database/AddNotes.php',{Note:valueFromInput}, function(data){
              if(data==true){
                console.log('successfully, done');

              }else{
                console.log('Error');
              }
        });
			
		} else {
			//get value from input field == The large text area 
			var valueFromInput = $("#toDoTextArea").val();
		    newListItem = $('#myList li:last').clone();
			//substitute values for the value before with what the user entered
			newListItem.find('textarea').attr('value', Value); 
			  $.post('database/AddNotes.php',{Note:valueFromInput}, function(data){
              if(data==true){
                console.log('successfully, done');

              }else{
                console.log('Error');
              }
        });
		}
		
		//show or not show clear all according the number of list items 
		//ie if there is one item in the list no need to show clear all
		var itemsInList = $("#myList li").length + 1;
		
		if ( itemsInList > 1) {
			$('#btnClear').css('display','block');
		}else{
			$('#btnClear').css('display','none');
			
		}
		$('#myList').append(newListItem);
		$('#toDoTextArea').val('');			//clear val
		$('#toDotextArea').focus();			//re-focus for new entry
		//this makes the notes dragable 
		$('.sortable').sortable('destroy');
		$('.sortable').sortable({
		handle: '.handle'


	 
			
		});

		//saving code first is the name: then what we are putting in there
		//localStorage.setItem('listReferenceKey', myList.innerHTML);
		
		});
		  
		  $('input[type="text"]').on('keydown', function(e){
			
				//
			  
			  var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode: 0;
			  //this is the enter button key on the keyboard
			  if(key == 13){

				  e.preventDefault();
				 
				  //this is the enter or the return key
				  //the field we are on ie this
				  var inputs = $(this).closest('form1').find(':input:visible');
				  //stop enter button from creating problems 
				  inputs.eq(inputs.index(this)+1).focus();
				  
			  }
		  });
									 
									 

		  //hold all list items 
		 //  $('#myList').on('change', '.listItem', function(e){
			// localStorage.setItem('listReferenceKey', myList.innerHTML);//storage again  
			//   currentValue = $(this).val();
			//   $(this).attr('value', currentValue);
		 //  });
		  
		  //check to see if list is resorted 
		  // $('.sortable').sortable().bind('sortupdate',function(){
	   //     localStorage.setItem('listReferenceKey', myList.innerHTML);
		  // });
		  
		  //remove code - for showing the red x
		  //what we are targeting 
		  $('#myList').on('mouseover','li', function(){
			  //refer to particular moused over list item
			  var $thisA = $(this).find('a');//find anchor tag
			  $thisA.css('display', 'block');//change display propertie into whatere we want to change ot to 
  
		  });

		   $('#myList').on('mouseout','li', function(){
			  var $thisA = $(this).find('a');
			  $thisA.css('display', 'none');

		  });
		  
		  $('#myList').on('click','.removeListXbtn', function(e){
			  e.preventDefault();
			  var id = $(this).attr('id');

			  	  $.post('database/DeleteNotes.php',{NoteId:id}, function(data){
              if(data==true){
                console.log('successfully, done');
                console.log($(this).parent());
                $(this).parent().remove();
              }else{
                console.log('Error');
              }
        });

			  //this is the anchor tag so we want to remove it and it's paent 
			  //localStorage.setItem('listReferenceKey', myList.innerHTML);//to remember if we cleared the list
		  });
		  
		  //code to clear all the list items
		  // $('#btnClear').on('click', '#clearAll', function(e){
			 //  var confirmMessage = confirm("Are you sure you want to delete all the files!");
			 //  if (confirmMessage == true) {
   	// 				$('#myList').children().remove();
			 //   		newNotesList = true;

				// 	//reset list items
			 //  		$('#toDoTextArea')
				// 	$('#btnClear').css('display','none');//hide clear all link
			 //    	$('#toDoTextArea').focus();
			 //   		localStorage.setItem('listReferenceKey', myList.innerHTML);//stroring of the list items 
			 //  }
			 //  else {
    			   
			 //  }
			   
		  // });
		  	  //function to handle page load
		  //loadToDo();
		  
		  // function loadToDo(){

			 //  	if(localStorage.getItem('listReferenceKey')){
				// ///just in case
				// //localStorage.clear();
				// myList.innerHTML = localStorage.getItem('listReferenceKey');
				// //re-enable sorting 
				// $('.sortable').sortable('destroy');
				// $('.sortable').sortable({
				// handle: '.handle'
						
				// });
			 //  }
		  // }
	
		
});
