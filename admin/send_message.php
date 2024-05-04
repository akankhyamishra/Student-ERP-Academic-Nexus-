<?php
include('../includes/config.php');

// Fetch messages for the selected student
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $messages_query = mysqli_query($db_conn, "SELECT * FROM messages WHERE receiver_id = $student_id ORDER BY timestamp ASC");
    $messages = [];
    while ($message = mysqli_fetch_assoc($messages_query)) {
        $messages[] = $message;
    }
    echo json_encode(['messages' => $messages]);
} else {
    echo json_encode(['error' => 'No student selected']);
}
?>
