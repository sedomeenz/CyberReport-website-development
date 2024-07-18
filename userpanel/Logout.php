<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS_files/logout.css">
    <title>Logout | CyberReport</title>
</head>
<body>
    <div class="container">
        <h1>Are you sure you want to logout? ):</h1>
        <a href="/Login.php" onclick="deleteAllCookies();sessionStorage.clear();"> Yes</a>
        <br><br>
        <a href="./Userpanel.php">NO</a>
    </div>

    <script src="/func/func_logout.js" >
    </script>

</body>
</html>