<?php
// Database credentials

$dbHost = '***************';  // MySQL server (usually 'localhost')
$dbUsername = '***********';  // MySQL username
$dbPassword = '***********';  // MySQL password
$dbName = 'CyberReport';  // MySQL database name

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
