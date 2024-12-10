<?php 
require '../../backend/database/databaseConnection.php';

session_start();
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $userId = $_POST['userId'];
    $itemId = $_POST['itemId'];
    $itemType = $_POST['itemType'];
    $quantity = $_POST['quantity'];

    if(!empty($userId) && !empty($itemId) && !empty($itemType) && !empty($quantity)){
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
    
        $insert = $conn->prepare("INSERT INTO cart (userId, itemId, itemType, itemBrand, itemModel, itemPhoto, quantity, itemPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert->bind_param("iissssis", $userId, $itemId, $itemType, $itemBrand, $itemModel, $itemPhoto, $quantity, $itemPrice);

        if($insert->execute()){
            echo json_encode(['status' => 'success', 'message' => 'Added to cart successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add to cart']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user, item ID, item type, or quantity']);
    }
}
?>