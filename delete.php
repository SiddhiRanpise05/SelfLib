<?php
include 'db_connection.php';

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the filename from the database based on the provided ID
    $sql = "SELECT filename FROM pdf_files WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filename = $row['filename'];

        // Delete the record from the database
        $deleteSql = "DELETE FROM pdf_files WHERE id = $id";
        if ($conn->query($deleteSql) === true) {
            // Delete the corresponding PDF file from the server
            $filePath = 'uploads/' . $filename;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}

// Close the database connection
$conn->close();

// Return to the same page
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>
