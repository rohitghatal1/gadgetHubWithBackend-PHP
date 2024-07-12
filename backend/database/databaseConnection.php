<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "gadgethub";
// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

else{
    echo "<script>console.log('Connected Successfully')</script>";
}
?>