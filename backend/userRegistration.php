<?php require '/backend/database/databaseConnection'; ?>
<?php

$userData = json_decode(file_get_contents("php://input"), true);

$name = $userData['name'];
$address = $userData['address'];
$contact = $userData['contact'];
$email = $userData['email'];
$username = $userData['username'];
$password = password_hash($userData['password'], PASSWORD_BCRYPT);

$insertUser = $conn->prepare("INSERT INTO users (uName, uAddress, uContact, uEmail, username, uPasswrod) VALUES (?, ?, ?, ?, ?, ?)");
$insertUser->bind_param("ssssss", $name, $address, $contact, $email, $username, $password);

if($insertUser->execute()){
    echo json_encode(["message" => "User Registered successfully"]);
}
else{
    echo json_encode(["message" => "Error: " . $insertUser->error]);
}
$insertUser->close();
$conn->close();
?>