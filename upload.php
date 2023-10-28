<?php

include 'db_connection.php';
// Configuration
$uploadDir = 'uploads/';  // Specify the directory where you want to save the uploaded PDF files
$allowedExtensions = ['pdf'];  // Specify the allowed file extensions

// Database connection
$servername = 'localhost:3306';
$username = 'root';
$password = '';  // Enter your database password here
$dbname = 'books';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Alter table to modify the "id" column
$alterTableSql = "ALTER TABLE pdf_files MODIFY COLUMN id INT AUTO_INCREMENT PRIMARY KEY";


// Check if a file was uploaded
if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['pdfFile'];

    // Validate file extension
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array($fileExtension, $allowedExtensions)) {
        die('Invalid file format. Only PDF files are allowed.');
    }

    // Generate a unique filename to avoid conflicts
    $filename = uniqid('pdf_', true) . '.' . $fileExtension;
    
    // Store the original filename
    $originalFilename = $file['name'];

    // Move the uploaded file to the destination directory based on page selection
    $pageSelection = $_POST['pageSelection'];  // Assuming the form field name is "pageSelection"
    $pageDirectory = $pageSelection . '/';
    if (!is_dir($uploadDir . $pageDirectory)) {
        mkdir($uploadDir . $pageDirectory, 0777, true);  // Create the page directory if it doesn't exist
    }
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $pageDirectory . $filename)) {
        // File upload success

        // Store metadata in the database
        $sql = "INSERT INTO pdf_files (filename, original_filename, page) VALUES ('$filename', '$originalFilename', '$pageSelection')";
        if ($conn->query($sql) === true) {
            // Redirect the admin to admin.html with success message
            header('Location: admin.html?message=success');
            exit;
        } else {
            echo 'Error storing metadata in the database: ' . $conn->error;
        }
    } else {
        echo 'Error uploading the file.';
    }
} else {
    echo 'No file was uploaded or an error occurred.';
}

// Close the database connection
$conn->close();
?>
