<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "login";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Close the connection (optional)
mysqli_close($conn);
?>
