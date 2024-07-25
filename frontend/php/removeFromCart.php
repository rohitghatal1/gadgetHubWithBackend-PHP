<?php
// Include the database connection file
require '../../backend/database/databaseConnection.php';

// Start the session
session_start();

// Check if itemId is set in the URL
if (isset($_GET['itemId'])) {
    // Get the itemId from the URL
    $itemId = intval($_GET['itemId']); // Convert to integer to prevent SQL injection

    // Ensure user is logged in
    if (isset($_SESSION['user'])) {
        $personId = $_SESSION["userId"];

        // Prepare the SQL statement to delete the item from the cart
        $deleteQuery = "DELETE FROM cart WHERE itemId = ? AND userId = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("ii", $itemId, $personId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Item removed form cart successfully')</script>";
            echo "<script>window.location.href = '../index.php'</script>";
        } else {
            // Handle error
            echo "Error removing item from cart.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where the user is not logged in
        echo "You need to log in to remove items from the cart.";
    }
} else {
    // Handle the case where itemId is not set
    echo "Invalid item ID.";
}

// Close the database connection
$conn->close();
?>
