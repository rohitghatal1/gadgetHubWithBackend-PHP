<?php
require '../../backend/database/databaseConnection.php';

$sql = "
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    itemId INT NOT NULL,
    itemType VARCHAR(50) NOT NULL,
    itemBrand VARCHAR(255) NOT NULL,
    itemModel VARCHAR(255) NOT NULL,
    itemPhoto VARCHAR(255),
    itemPrice DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(uId) ON DELETE CASCADE
);
";

if ($conn->query($sql) === TRUE) {
    echo "Table 'cart' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
