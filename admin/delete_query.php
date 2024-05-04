<?php
// Include the database configuration file
include('../includes/config.php');

// Check if query_id is set and not empty
if (isset($_GET['query_id']) && !empty($_GET['query_id'])) {
    // Sanitize the query ID to prevent SQL injection
    $query_id = mysqli_real_escape_string($db_conn, $_GET['query_id']);

    // Perform delete query
    $sql = "DELETE FROM student_queries WHERE id = '$query_id'";
    if (mysqli_query($db_conn, $sql)) {
        // Query deleted successfully
        // Redirect back to the same page after deletion
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Error deleting query
        echo "Error: " . mysqli_error($db_conn);
    }
} else {
    // Query ID not provided or empty
    echo "Query ID is missing.";
}
?>
