<?php 
require '../../backend/database/databaseConnection.php';

session_start();
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $userId = $_POST['userId'];
    $itemId = $_POST['itemId'];
    $itemType = $_POST['itemType'];

    if(!empty($userId) && !empty($itemId) && !empty($itemType)){
        $getUserName = "SELECT uName FROM users WHERE Id = ?";
        $stmt = $conn->prepare($getUserName);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $fetchedUserName = $stmt->get_result()->fetch_assoc();
        
        $getItemDetails = "SELECT * FROM $itemType WHERE Id = ?";
        $stmt = $conn->prepare($getItemDetails);
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $itemData = $stmt->get_result()->fetch_assoc();

        $itemBrand = $itemData['brand'];
        $itemModel = $itemData['model'];
        $itemPhoto = $itemData['photoPath'];
        $itemPrice = $itemData['price'];
    
        $insert = $conn->prepare("INSERT INTO cart (userId, itemId, itemType, itemBrand, itemModel, itemPhoto, itemPrice) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert->bind_param("iisssss", $userId, $itemId, $itemType, $itemBrand, $itemModel, $itemPhoto, $itemPrice);

        if($insert->execute()){
            echo json_encode(['status' => 'success', 'message' => 'Added to cart successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add to cart']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user, item ID, or item type']);
    }
}
?>