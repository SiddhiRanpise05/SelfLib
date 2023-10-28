<?php
// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';  // Enter your database password here
$dbname = 'books';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Retrieve the PDF file based on the page parameter
$page = $_GET['page'];
$sql = "SELECT filename FROM pdf_files WHERE page = '$page'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filename = $row['filename'];

    // Generate the correct file path
    $filePath = 'uploads/' . $page . '/' . $filename;

    // Output the file path
    echo $filePath;
} else {
    echo 'No PDF file found for ' . $page . '.';
}

// Close the database connection
$conn->close();
?>
