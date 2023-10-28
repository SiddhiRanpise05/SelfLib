<?php
include 'db_connection.php';

// Retrieve the list of uploaded PDFs
$sql = "SELECT * FROM pdf_files";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<table>';
  echo '<thead><tr><th>File Name</th><th>Actions</th></tr></thead>';
  echo '<tbody>';

  while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $filename = $row['filename'];
    $originalFilename = $row['original_filename'];

    echo '<tr>';
    echo '<td>' . $originalFilename . '</td>';
    echo '<td><a href="delete.php?id=' . $id . '">Delete</a></td>';
    echo '</tr>';
  }

  echo '</tbody>';
  echo '</table>';
} else {
  echo '<p>No PDFs uploaded yet.</p>';
}

// Close the database connection
$conn->close();
?>
