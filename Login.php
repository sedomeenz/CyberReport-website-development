<?php
include './DB.php';

$Error_message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from input user.
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to avoid SQL injection
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the username and password match the valid credentials.
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // print information's user in Database :

        //echo "<h2>User Information</h2>";
        //echo "<p>Username: " . htmlspecialchars($row['username']) . "</p>";
        //echo "<p>Password: " . htmlspecialchars($row['password']) . "</p>";
        //echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
        //print_r($row) ;

        // Authentication successful
        setcookie("is_logged", "true", time() + (7 * 24 * 60 * 60), "/");
        setcookie("username", $row['username'], time() + (7 * 24 * 60 * 60), "/");
        setcookie("user_id", $row['user_id'], time() + (7 * 24 * 60 * 60), "/");
        http_response_code(302);
        // Redirect to a welcome page or dashboard.
        header("Location: ./Userpanel.php");
        exit;
    } else {
        // Authentication failed
        $Error_message = "Your username and password are not valid, try again";
    }
}

if (!is_null($Error_message)) {
    echo "<p style='color: red; text-align: center; font-family: Jetbrains mono;'>$Error_message</p>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form | CyberReport </title> 
    <link rel="stylesheet" href="./CSS_files/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
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
