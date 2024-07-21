<?php 
require 'database/databaseConnection.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){

    $target_folder = '../laptopPhotos/';
    $target_file = $target_folder . basename($_FILES["laptopPhoto"]["name"]);
    move_uploaded_file($_FILES["laptopPhoto"]["tmp_name"], $target_file);

    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $processor = $_POST["processor"];
    $RAM = $_POST["RAM"];
    $graphics = $_POST["graphics"];
    $otherSpecifications = $_POST["specifications"];
    $price = $_POST["price"];
    $laptopImage = $target_file;

    $addLaptop = $conn->prepare("INSERT INTO laptops(brand, model, processor, RAM, graphics, otherSpecs, Lprice, photoPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $addLaptop->bind_param("sssissss", $brand, $model, $processor, $RAM, $graphics, $otherSpecifications, $price, $laptopImage);

    if($addLaptop->execute() === true){
        echo "<script>alert('Laptop added successfully')</script>";
        echo "<script>window.location.href='adminDashboard.php';</script>";
    }
    else {
        die("Error: " . $sql . "<br>" . $conn->error());
    }
    $addLaptop->close();
    $conn->close();
}