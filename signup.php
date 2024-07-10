<?php
include 'DB.php' ;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from input user.
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password == $confirm_password) {
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: /Login.php?message=you have registered successfully");
                exit;

            } else {
                $message = "Error: Could not execute the query.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Error: Could not prepare the query.";
        }
    } else {
        $message = "Passwords do not match.";
    }

    mysqli_close($conn);

    if (isset($message)) {
        echo "<p style='color: red; text-align: center; font-family: Jetbrains mono;'>$message</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Form | CyberReport</title>
  <link rel="stylesheet" href="./CSS_files/signup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Signup Form</span></div>

      <form action="./signup.php" method="POST">
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="row">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <div class="row button">
          <input type="submit" id="submit" value="Signup">
        </div>
        <div class="signin-link">Already a member? <a href="./Login.php">Login here</a></div>
      </form>

    </div>
  </div>
</body>
</html>
