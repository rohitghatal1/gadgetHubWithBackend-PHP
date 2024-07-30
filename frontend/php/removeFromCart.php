<?php
// Include the database connection file
require '../../backend/database/databaseConnection.php';

// Start the session
session_start();

// Check if itemId and itemType are set in the URL
if (isset($_GET['itemId']) && isset($_GET['itemType'])) {
    // Validate and sanitize inputs
    $itemId = intval($_GET['itemId']);
    $itemType = $_GET['itemType'];

    // Ensure user is logged in
    if (isset($_SESSION['userId'])) {
        $personId = intval($_SESSION['userId']);

        // Prepare the SQL statement to delete the item from the cart
        $deleteQuery = "DELETE FROM cart WHERE itemId = ? AND itemType = ? AND userId = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("isi", $itemId, $itemType, $personId);

        // Execute the statement and check if successful
        if ($stmt->execute()) {
            echo "<script>alert('Item removed from cart successfully.');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        } else {
            // Handle error
            echo "<script>alert('Error removing item from cart. Please try again later.');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where the user is not logged in
        echo "<script>alert('You need to log in to remove items from the cart.');</script>";
    }
} else {
    // Handle the case where itemId or itemType is not set
    echo "<script>alert('Invalid item ID or type.');</script>";
}

// Close the database connection
$conn->close();
?>
