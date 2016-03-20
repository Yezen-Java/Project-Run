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

}





 ?>