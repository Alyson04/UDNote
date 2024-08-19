<?php
session_start();
include '../pages/_dbconn.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'User not logged in']);
    exit();
}

// Get request body
$input = json_decode(file_get_contents('php://input'), true);
$title = isset($input['note']['title']) ? $conn->real_escape_string($input['note']['title']) : '';
$description = isset($input['note']['description']) ? $conn->real_escape_string($input['note']['description']) : '';

// Check if title and description are not empty
if (empty($title) || empty($description)) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Title and description cannot be empty']);
    exit();
}

// Insert new note
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO notes (user_id, title, description, date) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Failed to prepare statement', 'error' => $conn->error]);
    exit();
}

$stmt->bind_param("sss", $user_id, $title, $description);
if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Note added successfully']);
} else {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Error adding note', 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
