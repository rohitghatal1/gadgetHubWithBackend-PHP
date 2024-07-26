<?php
// Include the database connection file
require '../backend/database/databaseConnection.php';

// Initialize cart items count
$allCartItems = 0;

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $personId = $_SESSION["userId"];

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
<div class="myCartModal rounded" id="myCart"
    style="display:none; position:fixed; top: 0; right:6rem; width:60rem; z-index:11; background-color: #c4dfe6;">
    <div class="container p-2 d-flex justify-content-between align-items-center bg-dark text-light">
        <h2 class="hFont text-center p-1">My Cart ~ <?php echo "Rohit Ghatal"; ?></h2>
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
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['user'])) {
                    // Fetch cart details
                    $getCartDetails = "SELECT * FROM cart WHERE userId = ?";
                    $stmt = $conn->prepare($getCartDetails);
                    $stmt->bind_param("i", $personId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are items in the cart
                    if ($result->num_rows > 0) {
                        $cartItemsCount = 1;
                        while ($cartData = $result->fetch_assoc()) {
                            $itemId = $cartData['itemId']; ?>
                <tr>
                    <td><?php echo $cartItemsCount; ?></td>
                    <td><?php echo htmlspecialchars($cartData['itemBrand']); ?></td>
                    <td><?php echo htmlspecialchars($cartData['itemModel']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($cartData['itemPhoto']); ?>" alt=""
                            style="width:80%; height:8rem;"></td>
                    <td><?php echo htmlspecialchars($cartData['itemPrice']); ?></td>
                    <td>
                        <a href="php/removeFromCart.php?itemId=<?php echo urlencode($itemId); ?>"
                            class="text-decoration-none p-1 bg-danger text-light fw-bold rounded">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    </td>
                </tr>
                <?php $cartItemsCount++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No items added to cart</td></tr>";
                    }
                    $stmt->close();
                } else {
                    echo "<tr><td colspan='6'>No items added to cart</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>