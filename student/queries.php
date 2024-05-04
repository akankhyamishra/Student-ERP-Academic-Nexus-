<?php
include('../includes/config.php');

// Fetch messages from the admin
$messages_query = mysqli_query($db_conn, "SELECT * FROM messages WHERE receiver_id = 1 ORDER BY timestamp ASC");
$messages = [];
while ($message = mysqli_fetch_assoc($messages_query)) {
    $messages[] = $message;
}
echo json_encode(['messages' => $messages]);
?>
