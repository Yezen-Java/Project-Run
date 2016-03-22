<?php

  error_reporting(E_ALL & ~E_NOTICE);
  include("database/signUpValidation.php");
  $userclass = new UserClass();
  if (isset($_POST['btlogin'])) {
    $username = $_POST['form-username'];
    $password = $_POST['form-password'];
    $userclass->loginUserSession($username,$password);
  }

if (isset($_POST['signup'])){
      $fname= pg_escape_string($_POST['firstname']);
      $lastname=pg_escape_string($_POST['lastname']);
      $email=pg_escape_string($_POST['form-create-email']);
      $username=pg_escape_string($_POST['form-create-username']);
      $password= pg_escape_string($_POST['form-create-password']);
      $checkUserValidation = $userclass->checkUser($email,$username);
      if($checkUserValidation){
      $userclass-> signUpuser($fname,$lastname,$email,$username,$password); 

    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hive Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-1.22.0.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script type="text/javascript" src="database/registration.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/qunit/qunit-1.14.0.js"></script>
        <script src="tests.js"></script>
        <script src="script.js"></script>
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
                              <form method="post" action="">
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