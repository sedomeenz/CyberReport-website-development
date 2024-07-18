<?php
$is_logged = isset($_SESSION["is_logged"]) ? $_SESSION["is_logged"] : "";
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "";

// Check if user is logged in and username is not null
if ($is_logged == "true" && isset($user_id)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User panel | CyberReport</title>
    <link rel="stylesheet" href="/CSS_files/panel.css">
    <style>
        body {
            font-family: Jetbrains mono,Hack;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Panel</h1>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="./Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <aside>
            <ul>
                <li><a href="#">Overview</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </aside>
        <section class="content">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
            <p>This is your user panel. Here you can manage your account, check messages, and update settings.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 CyberReport website. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
} else {
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
font-style:initial ;
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
?>
