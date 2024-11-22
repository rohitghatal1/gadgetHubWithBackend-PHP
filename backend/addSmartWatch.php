<?php 
require 'database/databaseConnection.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){

    $target_folder = '../watchPhotos/';
    $target_file = $target_folder . basename($_FILES["watchPhoto"]["name"]);
    move_uploaded_file($_FILES["watchPhoto"]["tmp_name"], $target_file);

    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $otherSpecifications = $_POST["specifications"];
    $quantity = $_POST["wQuantity"]
    $price = $_POST["price"];
    $watchImage = $target_file;

    $addWatch = $conn->prepare("INSERT INTO watches(brand, model, otherSpecs, wquantity,  price, photoPath) VALUES (?, ?, ?, ?, ?, ?)");
    $addWatch->bind_param("sssiss", $brand, $model, $otherSpecifications, $quantity, $price, $watchImage);

    if($addWatch->execute() === true){
        echo "<script>alert('Watch added successfully')</script>";
        echo "<script>window.location.href='adminDashboard.php';</script>";
    }
    else {
        die("Error: " . $sql . "<br>" . $conn->error());
    }
    $addLaptop->close();
    $conn->close();
}