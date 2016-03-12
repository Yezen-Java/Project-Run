<?php 

include 'Connect.php';

if ($dbconn ) {
      echo "Databse Connected";
  }

function createUserAccount($firstName, $lastName, $email, $username, $password){
     
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          echo " Please Enter Vaild Email";
      	}else{		

          	if(chechInput($email,$username)){
              $query = "INSERT into users (Firstname, Lastname,Email,Username, Password) values ($1,$2,$3,$4,$5)";
              $result = pg_prepare($dbconn,"insertQuery",$query);
              	$result = pg_execute($dbconn,"insertQuery", array($firstName, $lastName, $email, $username, $password));
                  echo "You have Successfully Registered";
      pg_close ($connection);
    }else{
      echo "Username or email already exists";
    }
  }
}

function chechInput($usernameInput, $emailInput){

	$Query = "SELECT * FROM users WHERE $1=$2";
	$results= pg_prepare($dbconn,"queryCheck",$Query);
  if($results){
	$resultUser = pg_execute($dbconn, "queryCheck", array("email",$emailInput));
	$resultemail = pg_execute($dbconn,"queryCheck",array("username",$usernameInput));
   }else{
  echo "Could not access data, try again later";
}
	if (pg_num_rows($resultUser) == 0&& pg_num_rows($resultemail)==0) {
		return true;
	}else{

		return false;
	}

}




     // $resultemail = pg_query("SELECT * FROM users WHERE Email='$email'");
          // $resultuser = pg_query("SELECT * FROM users WHERE Username='$username'");
          // $dataEmail = pg_num_rows($resultemail);
          // $dataUsername = pg_num_rows($resultuser);



 ?>