<?php
require '../../backend/database/databaseConnection.php';

header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Sanitize input
$id = intval($_GET['id']);
$category = $_GET['category'] ?? '';
$validTables = ['laptops', 'mobiles', 'watches'];

if (!in_array($category, $validTables)) {
    echo json_encode(['error' => 'Invalid category']);
    exit();
}

$tableName = $category; // Use sanitized category

$stmt = $conn->prepare("SELECT * FROM $tableName WHERE Id = ?");
if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Item not found']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'Failed to prepare statement']);
}
$conn->close();