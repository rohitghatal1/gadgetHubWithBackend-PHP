<?php
require '../../backend/database/databaseConnection.php';

header('Content-Type: application/json');

$id = intval($_GET['id']);
$category = $_GET['category'] ?? '';
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
    default:
        echo json_encode(['error' => 'Invalid category']);
        exit();
}

$stmt = $conn->prepare("SELECT * FROM $tableName WHERE Id = ?");
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Item not found']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'Failed to prepare statement']);
}
$conn->close();