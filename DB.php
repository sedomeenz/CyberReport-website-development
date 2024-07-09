<?php
// Database credentials
$dbHost = 'localhost';  // MySQL server (usually 'localhost')
$dbUsername = 'username';  // MySQL username
$dbPassword = '***********';  // MySQL password
$dbName = 'CyberReport';  // MySQL database name

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";
?>
