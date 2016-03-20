<?php 

include 'Connect.php';


Class UserClass{


  public function signUpuser($fname,$lastname,$email,$username,$password){

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          echo " Please Enter Vaild Email";
      }else{
              $query = pg_query("INSERT into users (Firstname, Lastname,Email,Username, Password) values ('{$fname}', '{$lastname}','{$email}','{$username}','{$password}')"); // Insert query
              if($query){
                  echo "You have Successfully Registered";
              }else{
                  echo "Error!!";
              }
      }
      pg_close ($connection);
}

public function checkUser($email,$username){

  $resultemail = pg_query("SELECT * FROM users WHERE Email='{$email}'");
  $resultuser = pg_query("SELECT * FROM users WHERE Username='{$username}'");
  $dataEmail = pg_num_rows($resultemail);
  $dataUsername = pg_num_rows($resultuser);

      if(($dataEmail)==0 &&($dataUsername)==0 ){

        return true;
  
  }

return true;

}

public function loginUserSession($username,$password){

$escape = pg_escape_string($username);
$result = pg_query("SELECT * FROM users WHERE Username='{$escape}'");

if ($result) {
  $row = pg_fetch_row($result);
  $userId = $row[0];
  $usernameR = $row[3];
  $passwordR = $row[5];
  $active = $row[7];
}
if($username === $usernameR  && $password === $passwordR && $active == 1){
  session_start();
  $_SESSION['username'] = $username;
  $_SESSION['id'] = $userId;
  pg_close();
    header('Location: index.php');
   return true;
}else{
  echo"Invalid Username or password";

}
return false;

}


public function setUserActivition($userid,$number,$dbconn){
  $Query = "UPDATE users set active = $1 where userid = $2";
  $results = pg_prepare($dbconn,"queryUpdate",$Query);
  $results = pg_execute($dbconn,"queryUpdate",array($number,$userid));

  if(pg_affected_rows($results)){

    return true;
  }
return false;
}

}








 ?>