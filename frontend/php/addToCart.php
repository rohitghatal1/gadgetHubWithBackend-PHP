<?php 
require '../../backend/database/databaseConnection.php';

session_start();
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $userId = $_POST['userId'];
    $mobileId = $_POST['mobileId'];

    if(!empty($userId) && !empty($mobileId)){
        $getUserName = "SELECT uName FROM users WHERE uId = $userId";
        $fetechedUserName = $conn->query($getUserName);
        $userName = $fetechedUserName->fetch_assoc();

        $getMobileDetails = "SELECT * FROM mobiles WHERE MId = $mobileId";
        $fetechedMobileData = $conn->query($getMobileDetails);
        $mobileData = $fetechedMobileData->fetech_assoc();
        
        $mobileBrand = $mobileData['brand'];
        $mobileModel = $mobileData['model'];
        $mobilePhoto = $mobileData['photoPath'];
        $mobilePrice = $mobileData['Mprice'];
    
        $insert = $conn->prepare("INSERT INTO cart(itemBrand, itemModel, itemPhoto, itemPrice) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $mobileBrand, $mobileModel, $mobilePhoto, $mobilePrice);

        if($insert->execute()){
            echo "<script>alert('Added to cart successfully')</script>";
        }
    }
}