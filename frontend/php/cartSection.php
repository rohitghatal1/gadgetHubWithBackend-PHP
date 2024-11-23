<?php
// Include the database connection file
require '../backend/database/databaseConnection.php';

$allCartItems = 0;
$userName = "";
// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $personId = $_SESSION["userId"];
    $getUserName = "SELECT uName FROM users WHERE Id = $personId";
    $fetchedUserName = $conn->query($getUserName);
    $userNames = $fetchedUserName->fetch_assoc();
    $userName = $userNames['uName'];    

    // Fetch the count of items in the cart
    $getCartItems = "SELECT COUNT(id) AS totalCartItems FROM cart WHERE userId = ?";
    $stmt = $conn->prepare($getCartItems);
    $stmt->bind_param("i", $personId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartItem = $result->fetch_assoc();
    $allCartItems = $cartItem['totalCartItems'];
    $stmt->close();
}
?>

<!-- My Cart Modal -->
<div class="myCartModal rounded" id="myCart">
    <div class="container p-2 d-flex justify-content-between align-items-center bg-dark text-light">
        <h2 class="hFont text-center p-1">My Cart: <?php echo $userName; ?></h2>
        <span style="font-size:2rem; cursor:pointer;" onclick="closeMyCart()">&times;</span>
    </div>
    <h4 class="textFont p-1 container">Items Added to Cart</h4>
    <div class="itemsTable container" style="max-height: 80vh; overflow-y: auto;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Items</th>
                    <th>Model</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $placeOrderBtn = "<button class='btn p-1 bg-warning text-dark'>
                                    <i class='fa fa-exclamation-circle'></i> Cart is Empty
                                </button>";
                $totalPrice = 0; // Initialize total price
                if (isset($_SESSION['user'])) {
                    // Fetch cart details
                    $getCartDetails = "SELECT * FROM cart WHERE userId = ?";
                    $stmt = $conn->prepare($getCartDetails);
                    $stmt->bind_param("i", $personId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are items in the cart
                    if ($result->num_rows > 0) {
                        $placeOrderBtn = '<button class="btn" style="background-color: #28a745; color: #ffffff;" onclick="openPlaceOrder()">
                                            <i class="fas fa-shopping-bag"></i> Place Order
                                        </button>';
                        $cartItemsCount = 1;
                        while ($cartData = $result->fetch_assoc()) {
                            $itemId = $cartData['itemId'];
                            $itemType = $cartData['itemType'];
                            $itemPrice = floatval($cartData['itemPrice']); // Convert price to float
                            $totalPrice += $itemPrice; // Add item price to total
                ?>
                <tr>
                    <td><?php echo $cartItemsCount; ?></td>
                    <td><?php echo htmlspecialchars($cartData['itemBrand']); ?></td>
                    <td><?php echo htmlspecialchars($cartData['itemModel']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($cartData['itemPhoto']); ?>" alt=""
                            style="width:80%; height:8rem;"></td>
                    <td><?php echo number_format($itemPrice, 2); ?></td>
                    <td>
                        <a href="php/removeFromCart.php?itemId=<?php echo urlencode($itemId); ?>&itemType=<?php echo urlencode($itemType); ?>"
                            class="text-decoration-none p-1 bg-danger text-light fw-bold rounded">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    </td>
                </tr>
                <?php
                            $cartItemsCount++;
                        }
                ?>
                <!-- Display the total price -->
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold;">Total:</td>
                    <td><?php echo number_format($totalPrice, 2); ?></td>
                    <td></td>
                </tr>
                <?php
                    } else {
                        echo "<tr><td colspan='6'>No items added to cart</td></tr>";
                        $placeOrderBtn = "<button class='btn p-1 bg-warning text-dark'>
                        <i class='fa fa-exclamation-circle'></i> Cart is Empty
                        </button>";
                    }
                    $stmt->close();
                } else {
                    echo "<tr><td colspan='6'>No items added to cart</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="6">
                        <?php echo $placeOrderBtn ?>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>