<?php 
require '../../backend/database/databaseConnection.php';

session_start();
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $userId = $_POST['userId'];
    $itemId = $_POST['itemId'];
    $itemType = $_POST['itemType'];

    if(!empty($userId) && !empty($itemId) && !empty($itemType)){
        // Query for the user and item details based on itemType
        $getUserName = "SELECT uName FROM users WHERE uId = $userId";
        $fetchedUserName = $conn->query($getUserName);
        $userName = $fetchedUserName->fetch_assoc();

        $getItemDetails = "SELECT * FROM $itemType WHERE Id = $itemId";
        $fetchedItemData = $conn->query($getItemDetails);
        $itemData = $fetchedItemData->fetch_assoc();

        $itemBrand = $itemData['brand'];
        $itemModel = $itemData['model'];
        $itemPhoto = $itemData['photoPath'];
        $itemPrice = $itemData['price'];
    
        $insert = $conn->prepare("INSERT INTO cart(itemBrand, itemModel, itemPhoto, itemPrice) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $itemBrand, $itemModel, $itemPhoto, $itemPrice);

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
