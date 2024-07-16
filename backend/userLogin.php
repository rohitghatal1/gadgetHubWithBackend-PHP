<?php 
session_start();
require 'database/databaseConnection.php';

$username = $_POST['uName'];
$password = $_POST['uPassword'];

// Hashing the password to match the stored hashed password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$getUserData = "SELECT uId, username, uPassword FROM users WHERE username = ?";
$getStmt = $conn->prepare($getUserData);
$getStmt->bind_param("s", $username);
$getStmt->execute();
$result = $getStmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the hashed password
    if (password_verify($password, $row['uPassword'])) {
        $_SESSION['user'] = $row['username'];
        $_SESSION['userId'] = $row['uId'];
        echo "<script> alert('Login successful')</script>";
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        // exit();
    } else {
        echo "Invalid Password";
    }
} else {
    echo "User not found";
}

$getStmt->close();
$conn->close();
?>