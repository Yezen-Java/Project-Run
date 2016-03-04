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