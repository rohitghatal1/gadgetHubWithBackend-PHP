<?php
require 'database/databaseConnection.php';

if (isset($_POST['id']) && isset($_POST['category'])) {
    $id = (int)$_POST['id'];
    $category = $_POST['category'];

    error_log("ID: $id, Category: $category");

    // Prepare the SQL statement with parameterized query to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM $category WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        echo "Record deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
