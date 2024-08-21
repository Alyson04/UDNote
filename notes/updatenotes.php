<?php
session_start();
include '../pages/_dbconn.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'User not logged in']);
    exit();
}

// Decode input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['note']['id']) || !isset($input['note']['title']) || !isset($input['note']['description'])) {
    echo json_encode(['message' => 'Invalid input']);
    exit();
}

$id = intval($input['note']['id']);
$title = $conn->real_escape_string($input['note']['title']);
$description = $conn->real_escape_string($input['note']['description']);

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Prepare and execute the update statement
$sql = "UPDATE notes SET title = ?, description = ?, date = NOW() WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['message' => 'Failed to prepare statement']);
    exit();
}

$stmt->bind_param("ssii", $title, $description, $id, $user_id);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Note updated successfully']);
} else {
    echo json_encode(['message' => 'Error updating note']);
}

$stmt->close();
$conn->close();




// if (!hash_equals($_SESSION['csrf_token'], $_SERVER['HTTP_X_CSRF_TOKEN'])) {
//     http_response_code(403);
//     echo json_encode(['error' => 'CSRF token mismatch']);
//     exit;
// }

// $data = json_decode(file_get_contents('php://input'), true);

// $title = filter_var($data['note']['title'], FILTER_SANITIZE_STRING);
// $description = filter_var($data['note']['description'], FILTER_SANITIZE_STRING);
// $note_id = intval($data['note']['id']);

// // Get the logged-in user ID from the session
// $user_id = $_SESSION['user_id'];

// $query = "UPDATE notes SET title = ?, description = ?, date = NOW() WHERE id = ? AND user_id = ?";
// $stmt = $conn->prepare($query);
// $stmt->bind_param('ssii', $title, $description, $note_id, $user_id);

// if ($stmt->execute()) {
//     http_response_code(200);
//     echo json_encode(['message' => 'Note updated successfully']);
// } else {
//     http_response_code(500);
//     error_log("Error updating note: " . $stmt->error);
// }

// $stmt->close();
// $conn->close();