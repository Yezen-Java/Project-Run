<?php
  $dbconn = pg_connect("host=ec2-107-21-221-59.compute-1.amazonaws.com dbname=da2vmjb6giivfh user=enybctwamdyitl
  password=z3paibkPjPYeWNWib9d3nD0Pi8")
  or die('Could not connect: ' . pg_last_error());
  
  if ($dbconn ) {
      echo "Databse Connected";
  }
  if (isset($_POST['signup'])){
      $fname=$_POST['firstname']; 
      $lastname=$_POST['lastname'];
      $email=$_POST['form-create-email'];
      $username=$_POST['form-create-username'];
      $password= $_POST['form-create-password'];
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          echo " Please Enter Vaild Email";
      }else{
          $resultemail = pg_query("SELECT * FROM users WHERE Email='$email'");
          $resultuser = pg_query("SELECT * FROM users WHERE Username='$username'");
          $dataEmail = pg_num_rows($resultemail);
          $dataUsername = pg_num_rows($resultuser);
          
          if(($dataEmail)==0 &&($dataUsername)==0 ){
              $query = pg_query("INSERT into users (Firstname, Lastname,Email,Username, Password) values ('$fname', '$lastname','$email','$username','$password')"); // Insert query
              if($query){
                  echo "You have Successfully Registered";
              }else{
                  echo "Error!!";
              }
          }else{
              echo "This email is already registered, Please try another email";
          }
      }
      pg_close ($connection);
  }
  if (isset($_POST['btlogin'])) {
    include("database/UserLoginSession.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hive Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></script>
        <script type="text/javascript" src="database/registration.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></script>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" type="text/css" href="loginNew.css">
    </head>
    <body>
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="page-header">
                      <h1><strong>Hive</strong> Login</h1>
                    </div>   
                </div>
            </div>
            <div class="bottom-content">
               <div class="container">
                  <div id="theCarousel" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
                        <li data-target="#theCarousel" data-slide-to="1"> </li>
                     </ol >
                     <div class="carousel-inner">
                     <div class="item active" id="firstCarousel">
                        <div class ="slide1"></div>
                        <div class="carousel-caption">
                           <div class="col-sm-6 col-sm-offset-3 form-box">
                           <form method="post" action="login.php">
                              <div class="container" id="mainLogin">
                                 <h2><strong>Login</strong></h2>
                                    <div class="form-bottom" id="loginForm">
                                       <div class="form-group">
                                          <input type="text" name="form-username" placeholder="Username" class="form-username form-control"
                                          pattern="[A-Za-z0-9]{3,}" title="Only numbers and letters">
                                       </div>
                                       <div class="form-group">
                                          <input type="password" name="form-password" placeholder="Password" class="form-password form-control"
                                          pattern=".{4,}" title="At least four characters">
                                       </div>
                                        <div class="btn-group">
                                          <button class="btn btn-primary btn-lg" name="btlogin">Sign in</button>
                                          <button class="btn btn-primary btn-lg">Create Account</button>   
                                        </div>
                                    </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="item">
                           <div class="slide2"></div>
                            <div class="carousel-caption">
                              <div class="col-sm-6 col-sm-offset-3 form-box">
                              <form method="post">
                                 <div class="container" id="createAccountContainer">
                                    <h3><strong>Create</strong> account</h3>

                                    <div class="form-group" id="parent-name">
                                    <div id="finame-div"> <input type="text" class="form-control" name="firstname" placeholder="First Name" id="Cname"
                                    pattern="[A-Za-z0-9]{2,}" title="At least 2 or more letters, numbers">
                                    </div>
                                    <div id="laname-div"><input type="text" class="form-control" name="lastname" placeholder="Last Name" id="Clname"
                                    pattern="[A-Za-z0-9]{2,}" title="At least 2 or more letters, numbers"></div>
                                       
                                    </div>
                                    <div class="form-group">
                                       <input type="text" name="form-create-email" placeholder="Email" class="form-create-email form-control" id="form-email-css"
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="hint: random@test.co.uk">
                                    </div>
                                    <div class = "form-group">
                                       <input type="text" name="form-create-username" placeholder="Username" class="form-create-username form-control" id="form-user-css"
                                       pattern="[A-Za-z0-9]{3,}" title="Only numbers and letters">
                                    </div>
                                    <div>
                                    <div class = "form-group">
                                       <input type="password" name="form-create-password" placeholder="Password" class="form-create-password form-control" id="form-password-css"
                                       pattern=".{4,}" title="Four or more characters">
                                    </div>
                                    <div class = "form-group">
                                       <input type="password" name="form-create-password2" placeholder="Repeat Password" class="form-create-password form-control" id="form-password-css-repeat" 
                                       pattern=".{4,}" title="Four or more characters" onChange="checkPasswordMatch();">

                                    </div>
                                      <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                                    </div>
                                       <button class="btn btn-primary btn-lg" name = "signup">Create</button>
                                 </div>  
                                 </form>
                              </div>
                           </div>
                        </div>
                        <a class="left carousel-control" href="#theCarousel" data-slide="prev">
                           <span class="glyphicon glyphicon-chevron-left"> </span>
                        </a>
                        <a class="right carousel-control" href="#theCarousel" data-slide="next">
                           <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </body>

</html>