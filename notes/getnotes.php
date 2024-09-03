<?php
session_start();
header('Content-Type: application/json');
include '../pages/_dbconn.php';


// Get the logged-in user ID from the session
$user_id = $_SESSION['user_id'];

$query = isset($_GET['query']) ? filter_var($_GET['query'], FILTER_SANITIZE_SPECIAL_CHARS) : '';

$sql = "SELECT * FROM notes WHERE user_id = ?";
if (!empty($query)) {
    $sql .= " AND (title LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%'))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $user_id, $query, $query);
} else {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

$notes = array();
while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}

echo json_encode($notes);

$stmt->close();
$conn->close();

