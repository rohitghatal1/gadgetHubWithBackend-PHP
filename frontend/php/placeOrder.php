<?php 
require '../../backend/database/databaseConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uId = $_POST['userId'];
    $address = $_POST['address'];

    // Fetch cart data for the user
    $cartData = "SELECT * FROM cart WHERE userId = $uId";
    $fetchedCartData = $conn->query($cartData);

    if ($fetchedCartData->num_rows > 0) {
        while ($cartItems = $fetchedCartData->fetch_assoc()) {
            $userid = $cartItems['userId'];
            $itemid = $cartItems['itemId'];
            $itemType = $cartItems['itemType'];
            $itemBrand = $cartItems['itemBrand'];
            $itemModel = $cartItems['itemModel'];
            $itemPhoto = $cartItems['itemPhoto'];
            $itemPrice = $cartItems['itemPrice'];
            $orderDate = date('Y-m-d H:i:s');

            // Insert data into orders table
            $insertIntoOrders = "INSERT INTO orders (userId, itemId, itemType, itemBrand, itemModel, itemPhoto, itemPrice, cAddress, orderDate) 
                                 VALUES ('$userid', '$itemid', '$itemType', '$itemBrand', '$itemModel', '$itemPhoto', '$itemPrice', '$address', '$orderDate')";

            if ($conn->query($insertIntoOrders) === TRUE) {
                // Insert data into sales table
                $insertIntoSales = "INSERT INTO sales (userId, itemId, itemType, itemBrand, itemModel, itemPhoto, itemPrice, saleDate) 
                                    VALUES ('$userid', '$itemid', '$itemType', '$itemBrand', '$itemModel', '$itemPhoto', '$itemPrice', '$orderDate')";

                if ($conn->query($insertIntoSales) !== TRUE) {
                    echo "Error inserting data into sales table: " . $conn->error;
                }
                else{
                    echo "<script>alert('Order Placed successfully')</script>";
                    echo "<script>window.location.href = '../index.php'</script>";
                }
            } else {
                echo "Error inserting data into orders table: " . $conn->error;
            }
        }

        // Clear cart after moving items to orders and sales
        $clearCart = "DELETE FROM cart WHERE userId = $uId";
        if ($conn->query($clearCart) !== TRUE) {
            echo "Error clearing cart: " . $conn->error;
        }
    } else {
        echo "No items found in the cart.";
    }
}
$conn->close();
?>
