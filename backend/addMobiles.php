<?php 
require 'database/databaseConnection.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){

    // Combine them to get the target folder
    $target_folder = '../mobilePhotos/';

    $target_file = $target_folder . basename($_FILES["mobilePhoto"]["name"]);
    move_uploaded_file($_FILES["mobilePhoto"]["tmp_name"], $target_file);

    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $processor = $_POST["processor"];
    $RAM = $_POST["RAM"];
    $storage = $_POST["storage"];
    $otherSpecifications = $_POST["specifications"];
    $price = $_POST["price"];
    $mobileImage = $target_file;

    $addMobile = $conn->prepare("INSERT INTO mobiles(brand, model, processor, RAM, storage, otherSpecs, Mprice, photoPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $addMobile->bind_param("ssssssss", $brand, $model, $processor, $RAM, $storage, $otherSpecifications, $price, $mobileImage);

    if($addMobile->execute() === true){
        echo "<script>alert('Mobile added successfully')</script>";
        echo "<script>window.location.href='adminDashboard.php';</script>";
    }
    else {
        die("Error: " . $sql . "<br>" . $conn->error());
    }
    $addMobile->close();
    $conn->close();
}