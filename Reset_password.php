<?php
include './DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get username and password from input user.
  $username = $_POST['username'];
  $new_password = $_POST["new_password"];
  $confirm_password = $_POST["confirm_password"];
  
  if ($new_password == $confirm_password) {
    $query = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
    $result = mysqli_query($conn , $query);

      if($result === true) {
        $query = "UPDATE users SET token = 'null' WHERE password = '$new_password'";
        $token_null = mysqli_query($conn , $query);
        header("Location: ./Login.php?message=The new password has been set successfully");
        exit;

      }else{
        $Error_message1 = 'user is not found ):';
      }

  }else {
    $Error_message2 = 'Password do not match ,try again ):';
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password | CyberReport</title>
  <link rel="stylesheet" href="./CSS_files/reset_password.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Reset Password</span></div>
      <form action="./Reset_password.php" method="POST">
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="new_password" placeholder="New Password" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          <input type="hidden" name="username" value="<?php echo $row['username'];?>" >
        </div>
        <div class="row button">
          <input type="submit" id="submit" value="Reset Password">
        </div>

      </form>
    </div>
  </div>
  <?php
      echo "<p style='  font-size: larger;color: red;text-align: center; font-family: 'Jetbrains mono', Hack; margin-bottom: auto;'>$Error_message2</p>";
  ?>
  </body>
</html>
  <?php
  }

}else {
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $query = "SELECT * FROM users WHERE token = '$token'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $token_result = true;

  } else {
    $token_result = false;
  }

  if ($token_result == true) {
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password | CyberReport</title>
  <link rel="stylesheet" href="./CSS_files/reset_password.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Reset Password</span></div>
      <form action="./Reset_password.php" method="POST">
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="new_password" placeholder="New Password" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          <input type="hidden" name="username" value="<?php echo $row['username'];?>" >
        </div>
        <div class="row button">
          <input type="submit" id="submit" value="Reset Password">
        </div>

      </form>
    </div>
  </div>
<?php
  } else {
    echo "Invalid token.";
  }
?>
</body>
</html>
<?php    

}else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting | CyberReport</title>
    <style>
        body {
            background-color: rgba(0, 0, 0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            border: 2px solid black;
            padding: 20px;
            background-color: #0f0;
            text-align: center;
            font-family: Jetbrains mono;
        }
        .message {
            color: rgb(0, 0, 0);
            font-size: 24px;
            margin: 0;
        }
        .highlight {
            color: rgb(255, 0, 0);
            font-style: initial;
        }
        .border {
            border-color: black;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <p class="message">Oops! Something went wrong, you are <span class="highlight">invalid</span> person :(</p>
    </div>

    <script>
        function redirectWithMessage() {
            setTimeout(function() {
                window.location.href = "/Login.php"; 
            }, 2000);
        }
        window.onload = redirectWithMessage;
    </script>
</body>
</html>
<?php
}
}
?>