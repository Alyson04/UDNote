<?php
session_start();
include '../pages/_dbconn.php';

// Ensure the content type is set before any output
header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'User not logged in']);
    exit();
}

// Get request body
parse_str(file_get_contents('php://input'), $data);
$note_id = intval($data['note_id']);

// Validate note ID
if (empty($note_id)) {
    echo json_encode(['message' => 'Invalid note ID']);
    exit();
}

// Delete note
$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM notes WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['message' => 'Failed to prepare statement', 'error' => $conn->error]);
    exit();
}

$stmt->bind_param("ii", $note_id, $user_id);
if ($stmt->execute()) {
    echo json_encode(['message' => 'Note deleted successfully']);
} else {
    echo json_encode(['message' => 'Error deleting note', 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
