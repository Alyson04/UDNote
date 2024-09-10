<?php
session_start();
include '../pages/_dbconn.php';

if (isset($_GET['note_id'])) {
    $note_id = $_GET['note_id'];

    // Prepare SQL to fetch a specific note
    $sql = "SELECT * FROM notes WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $note_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($note = $result->fetch_assoc()) {
        $noteData = [
            'id' => htmlspecialchars($note['id']),
            'title' => htmlspecialchars($note['title']),
            'description' => htmlspecialchars($note['description']),
            'date' => htmlspecialchars($note['date'])
        ];

        header('Content-Type: application/json');
        echo json_encode($noteData);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Note not found']);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
