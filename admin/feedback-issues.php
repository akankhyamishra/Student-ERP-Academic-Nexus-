<?php
// Include the database configuration and any necessary files
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Retrieve list of students
$students_result = $db_conn->query("SELECT * FROM accounts WHERE type = 'student'");


$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['student_id'])) {
    // Retrieve student ID from the form
    $student_id = $_POST['student_id'];

    // Retrieve student's queries from the database
    $query_result = $db_conn->query("SELECT * FROM student_queries WHERE student_id = $student_id ORDER BY timestamp DESC");
} else {
    $query_result = null;
}



?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Feedbacks/Queries</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Feedbacks & Queries</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Card for selecting a student -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Select Student</div>
                <div class="card-body">
                    <form id="select-student-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="student">Select Student:</label>
                            <select class="form-control" id="student" name="student_id">
                                <option value="">Select a student</option>
                                <?php while ($row = $students_result->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">View Queries</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Card for displaying student's queries and admin replies -->
        <div class="col-md-8">
            <?php if ($query_result !== null): ?>
                <?php if ($query_result->num_rows > 0): ?>
                    <div id="accordion">
                        <?php while ($row = $query_result->fetch_assoc()): ?>
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapse<?php echo $row['id']; ?>">
                                       <b> <?php echo $row['subject']; ?></b>
                                        <i class="fas fa-chevron-down ml-auto"></i>
                                    </button>
                                </div>
                                <div id="collapse<?php echo $row['id']; ?>" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="query-box">
                                            <p class="query-box p-3 border"><?php echo $row['message']; ?></p>
                                            <div class="text-right mb-3">
                                                <small><?php echo date("F j, Y, g:i a", strtotime($row['timestamp'])); ?></small>
                                                <a href="delete_query.php?query_id=<?php echo $row['id']; ?>" class="text-danger ml-2" data-toggle="tooltip" data-placement="top" title="Delete Query"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                        <!-- Admin reply form -->
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <input type="hidden" name="query_id" value="<?php echo $row['id']; ?>">
                                            <div class="form-group">
                                              
                                                <label for="reply">Admin Reply:</label>
                                                <textarea class="form-control" id="reply" name="reply" rows="1" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
                                        </form>
                                        <?php
                                        // Fetch and display admin replies for this query
                                        $query_id = $row['id'];
                                        $admin_replies_result = $db_conn->query("SELECT * FROM admin_replies WHERE query_id = $query_id ORDER BY timestamp ASC");
                                        if ($admin_replies_result->num_rows > 0): ?>
                                            <div class="mt-3">
                                                <h6>Admin Replies:</h6>
                                                <ul class="list-group list-group-flush">
                                                    <?php while ($admin_reply_row = $admin_replies_result->fetch_assoc()): ?>
                                                        <li class="list-group-item">
                                                            <?php echo $admin_reply_row['reply']; ?>
                                                            <div class="text-right">
                                                                <small><?php echo date("F j, Y, g:i a", strtotime($admin_reply_row['timestamp'])); ?></small>

                                                            </div>
                                                        </li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info mt-3" role="alert">
                        No queries from this student.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// Handle reply submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    
    // Retrieve student's queries from the database
    $query_result = $db_conn->query("SELECT * FROM student_queries WHERE student_id = $student_id ORDER BY timestamp DESC");
}

// Handle reply submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['query_id'], $_POST['reply'])) {
    $query_id = $_POST['query_id'];
    $reply = $_POST['reply'];
    $admin_id = $_SESSION['user_id']; // Assuming admin is logged in

    // Insert reply into admin_replies table
    $stmt = $db_conn->prepare("INSERT INTO admin_replies (query_id, admin_id, reply) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $query_id, $admin_id, $reply);
    if ($stmt->execute()) {
        // Redirect to avoid resubmission on page refresh
        echo '<meta http-equiv="refresh" content="0;URL=\'feedback-issues.php\'" />';
        exit();
    } else {
        echo "Error submitting reply: " . $db_conn->error;
    }
}
?>




<?php include('footer.php');?>
