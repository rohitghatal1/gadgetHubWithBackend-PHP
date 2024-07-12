<?php
require '/gadgetHubWithBackend/backend/database/databaseConnection.php';

// Get the POST data
$fname = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the email already exists
$checkEmailQuery = "SELECT * FROM users WHERE email = ?";
$checkEmailStmt = $conn->prepare($checkEmailQuery);
$checkEmailStmt->bind_param("s", $email);
$checkEmailStmt->execute();
$existingEmail = $checkEmailStmt->get_result()->fetch_assoc();

// Check if the username already exists
$checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
$checkUsernameStmt = $conn->prepare($checkUsernameQuery);
$checkUsernameStmt->bind_param("s", $username);
$checkUsernameStmt->execute();
$existingUsername = $checkUsernameStmt->get_result()->fetch_assoc();

// Check if email or username already exists
if ($existingEmail) {
    echo "Email Already Used";
} elseif ($existingUsername) {
    echo "Username Already taken";
} else {
    // Insert new user data into the database
    $insertQuery = "INSERT INTO users (uName, uAddress, uContact, uEmail, username, uPassword) VALUES (?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ssssss", $fname, $address, $contact, $email, $username, $hashedPassword);

    if ($insertStmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error inserting data: " . $insertStmt->error;
    }

    $insertStmt->close();
}

$checkEmailStmt->close();
$checkUsernameStmt->close();
$conn->close();
?>
