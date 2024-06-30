<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form | CyberReport </title> 
    <link rel="stylesheet" href=".//CSS_files//login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>

<?php
$Error_message = null ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # valid user name.  
    $valid_username = "admin" ;
    $valid_password = "128128" ;

    # get username and password from input user.
    $username = $_POST["username"] ;
    $password = $_POST["password"] ;

    # check if the username and password match the valid credentials.
    if ($username == $valid_username && $password == $valid_password) {

      # Athentications successful
      setcookie("is_logged" , "true" , time() + (7 * 24 * 60 * 70),"/") ;
      setcookie("username" , $username , time() + (7 * 24 * 60 * 70),"/") ;
      http_response_code(302) ;

      header("Location: ./User_panel.php") ; # redirect to a wellcom page or dashboard.   
      exit ;
      
    }else {
      # Authentication failed
      $Error_message = "your usernmae and password not valid , try again" ;
    }
}
?>

<?php 
if (!is_null($Error_message)) {
  echo "<p style='color: red; text-align: center; font-family: Jetbrains mono' ;>$Error_message</p>";

}
?>
<body>
    <p class="text">Login page</p>

    <div class="container">
    
      <div class="wrapper">
        <div class="title"><span>Login Form</span></div>

        <form action="./Login.php" method="POST">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <div class="pass"><a href="#">Forgot password?</a></div>
          <div class="row button">
            <input type="submit" id="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="#">Signup now</a></div>
        </form>

      </div>
    </div>
  </body>
</html>