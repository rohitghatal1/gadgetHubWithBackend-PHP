<?php
$host = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
    
    // SQL to create database
    $createDB = "CREATE DATABASE IF NOT EXISTS gadgetHub";
    if($conn->query($createDB) === TRUE){
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }
}

// Close connection
$conn->close();
?>
