/*
Author: Team Potato
Date: 04/03/2016
Last Edited: 04/03/2016
Description: This javascript document contains QUnit tests which were used to test the JQuery/JScript 
backend of the Login and Index pages to ensure bugs are resolved or kept at a minimal to not interfere
with the performance of the tasks the system was designed to fulfill.
*/



QUnit.test('indexCompareFunction', function(assert){
	assert.strictEqual(compare(), 0, "No Parameters")
	assert.strictEqual(compare(1,2), -1, "Parameter one smaller than parameter 2")
	assert.strictEqual(comapre(300,99), 1, "Parameter one greater than parameter 2")
	assert.strictEqual(compare(2,2), 0, "Parameter a is equal to parameter b")
});

QUnit.test('EditTourName', function(assert){
	assert.deepEqual(EditTourName("TOR124","Openday"), null, "No value returned, Openday does exist")
});

QUnit.test('Save', function(assert){
	assert.equal(Save(), false, "The media is either added or not, if so the method returns false, all is good.")
	assert.notEqual(Save(), true, "The save() method can only return false, therefore this inequality test is satisfied.")
	assert.throws(Save(3), null, "Compile time error")
});

QUnit.test('w3_open', function(assert){
	assert.deepEqual(w3_open(), null, "Compile time error, no parameter passed.")
	assert.deepEqual(w3_open("FEW3422", ), null, "The value is a random string generated that is 6 characters long, this test should return a null.")
	assert.deepEqual(w3_open("TOR124", "Openday"), false, "This tour ID and name correspond in the database, method should return false.")
	assert.notEqual(w3_open("TOR124", "Open3Jd"), null, "If our parameters are invalid, then the method should return no value = null.")
});

QUnit.test('addLocations', function(assert){
	assert.equal(addLocations(), false, "Method called with no parameters should return false")
	assert.notEqual(addLocations(), null, "Method takes no parameters, but the inequality test should satisfy the return null.")
});

QUnit.test('appendMediaToLocation', function(assert){
	assert.equal(appendMediaToLocaition(), false, "Method called with no parameters should return false")
	assert.equal(appendMediaToLocaition(4), null, "A parameter added to a method that takes no parameter should return null.")
	assert.notEqual(appendMediaToLocaition(), true)
});

QUnit.test('getCheckedBoxes', function(assert){
	assert.deepEqual(getCheckedBoxes("checkboxlocation"), checkboxesChecked, "There exists more than 0 checked boxes, we return them.")
	assert.deepEqual(getCheckedBoxes("checkboxlocation"), null, "There exists no checked boxes, therefore the method returns null.")
});

QUnit.test('descriptionBoxEdit', function(assert){
	assert.deepEqual(descriptionBoxEdit(30), checkboxesChecked, "There exists more than 0 checked boxes, we return them.")
	assert.deepEqual(descriptionBoxEdit("checkboxlocation"), null, "There exists no checked boxes, therefore the method returns null.")
});



$mediaid = $rows['mediaid']; = idOfDescriptionBox

    // function descriptionBoxEdit(idOfDescriptionBox){
    //   var currentValue = null; 
    //   $(".textAreas").each(function(i,obj){
    //     if($(obj).attr('name') == idOfDescriptionBox){
    //       currentValue = $(obj).attr('name');
    //       $(obj).prop('disabled', function(i,v) {
    //         return !v;
    //       });
    //       var descriptionText = $(obj).val();
    //       $("button").each(function(i,bobj){
    //         if ($(bobj).attr('id') == currentValue ) {
    //           console.log(descriptionText);
    //           if($(bobj).text() == "Save" && descriptionText != ""){
    //             $(bobj).text("Edit");
    //             $.post('database/AddMediaDescription.php',{Mediaid:$(bobj).attr('id'),Description:descriptionText}, function(data){
    //               if(data == false){
    //                 alert("error");
    //               }else{
    //                 alert("works");
    //               }
    //             }); 
    //           } else {
    //             $(bobj).text("Save");
    //           }
    //         }
    //       });
    //     }
    //   });
    // }











