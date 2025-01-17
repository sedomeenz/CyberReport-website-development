<?php
include './DB.php';
session_start();

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
        $_SESSION['is_logged'] = true; 
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        http_response_code(302);
        // Redirect to a welcome page or dashboard.
        header("Location: ./userpanel/Userpanel.php");
        exit;
    } else {
        // Authentication failed
      $Error_message = "Your username and password are not valid, try again ):";  
      $username = $_POST['username'];
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | CyberReport</title>
  <link rel="stylesheet" href="./CSS_files/Login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>
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
        <?php 
        if (isset($username)) { 
          echo "<div class='pass-link'><a href='./Forget_password.php?username= $username '>Forgot password?</a></div>";
        }else { 
          echo "<div class='pass-link'><a href='./Forget_password.php'>Forgot password</a></div>"; }
        ?>
        <div class="row button">
          <input type="submit" id="submit" value="Login">
        </div>
        <div class="signin-link">Not a member?<a href="./signup.php">Signup here</a></div>
      </form>
    </div>
  </div>
<?php
if (!is_null($Error_message)) {
    echo "<div class='error-message'>$Error_message</div>";
}
?>
</body>
</html>