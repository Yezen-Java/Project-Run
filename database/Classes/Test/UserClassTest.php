<?php

/**
* 
*/
class UserClassTest extends PHPUnit_Framework_TestCase
{
	
	
	public function setUp(){

		$this->userClass = new UserClass();

	}

	//This function only return true if the user does not exsits in the database;
	public function signUpuserTest(){

		$results = $this->userClass->signUpuser('FirstName','LastName','useremail@email.com','username','12345');
	    $this->assertEquals(true,$results);

	}

	//Checks whether user esxits in the database or not;
	public function checkUserTest(){

		$results = $this->userClass->checkUser('user@mail.co.uk','newUser');
	    $this->assertEquals(true,$results);

	}
  
      //this allow the admin to set the activition for the new user.
	public function setUserActivition(){
        $results = $this->userClass->setUserActivition('username','1',$dbconn);
	    $this->assertEquals(true,$results);
	}

	/**
    *this checks if a user does exits, and if to then it will checks the input details
    *then if the user datils that they were input were correct.
    */

	public function loginUserSessionTest(){
		$results = $this->userClass->loginUserSession('username','12345');
	    $this->assertEquals(true,$results);

	}

	public function deleteUsersTest(){

		$results = $this->userClass->deleteUsers('username',$dbconn);
	    $this->assertEquals(true,$results);

	}
}



?>