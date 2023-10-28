<?php
$servername = "localhost";
$username = "root";
$password = ""; // Enter your database password here
$dbname = "books";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
