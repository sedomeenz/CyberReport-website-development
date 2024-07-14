<?php
include './DB.php';
include './Randomstring_func.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from input user.
    $username = $_POST['username'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn,$query);

    if ($result && mysqli_num_rows($result) == 1 ) {
        $row = mysqli_fetch_assoc($result);

        $randomString = md5(generateRandomString(10));
        $update_query = "UPDATE users SET token = '$randomString' WHERE username = '$username'";
        $update_result = mysqli_query($conn , $update_query);

        if ($update_result) {
            // Construct the reset link
            $reset_link = "./Reset_password.php?token=$randomString";
            // echo "Random String: " . $randomString;
            // echo "<br>";
             echo "Click the following link to reset your password: <a href='$reset_link'>reset your password</a>";
        } else {
            echo "Error updating token: " . mysqli_error($conn);
        }
    } else {
        echo "User not found.";
    }

} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forget Password | CyberReport</title>
  <link rel="stylesheet" href="./CSS_files/forget_password.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<body>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Forget Password</span></div>

      <form action="./Forget_password.php" method="POST">
        <div class="row">
          <i class="fas fa-envelope"></i>
          <input type="username" name="username" value="<?php if (array_key_exists('username', $_GET)) echo $_GET['username'];?>" placeholder="Enter your username" required>
        </div>
        <div class="row button">
          <input type="submit" id="submit" value="Reset Password">
        </div>
      </form>

    </div>
  </div>
  <?php
    if (isset($message)) {
     echo "<p style='font-size: larger; color: red; text-align: center; font-family: Jetbrains mono, Hack; margin-bottom: auto;'>$message</p>";
    }
  ?>
</body>
</html>