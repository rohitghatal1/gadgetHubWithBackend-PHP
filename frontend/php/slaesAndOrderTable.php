<?php
require '../../backend/database/databaseConnection.php';

// SQL statements to create 'orders' and 'sales' tables
$sql = "
CREATE TABLE IF NOT EXISTS orders (
    orderId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    itemId INT NOT NULL,
    itemType VARCHAR(255),
    itemBrand VARCHAR(255),
    itemModel VARCHAR(255),
    itemPhoto VARCHAR(255),
    itemPrice DECIMAL(10, 2),
    address TEXT,
    orderDate DATETIME,
    FOREIGN KEY (userId) REFERENCES users(Id)
);

CREATE TABLE IF NOT EXISTS sales (
    saleId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    itemId INT NOT NULL,
    itemType VARCHAR(255),
    itemBrand VARCHAR(255),
    itemModel VARCHAR(255),
    itemPhoto VARCHAR(255),
    itemPrice DECIMAL(10, 2),
    saleDate DATETIME,
    FOREIGN KEY (userId) REFERENCES users(Id)
);
";

// Execute the SQL script
if ($conn->multi_query($sql) === TRUE) {
    echo "Tables 'orders' and 'sales' created successfully.";
} else {
    echo "Error creating tables: " . $conn->error;
}

// Close the connection
$conn->close();
?>
