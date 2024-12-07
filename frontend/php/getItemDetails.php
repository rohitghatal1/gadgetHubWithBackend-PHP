<?php
include 'db_connection.php'; // Include your database connection

$id = $_GET['id'];
$category = $_GET['category'];
$tableName = ''; 

// Map category to table name
switch ($category) {
    case 'laptops':
        $tableName = 'laptops';
        break;
    case 'mobiles':
        $tableName = 'mobiles';
        break;
    case 'watches':
        $tableName = 'watches';
        break;
}

if ($tableName) {
    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE Id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Item not found']);
    }
    $stmt->close();
}
$conn->close();
?>