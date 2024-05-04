<?php
// Include the database configuration and any necessary files
include('../includes/config.php');
include('header.php');
include('sidebar.php');



// Initialize success and error messages
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the form fields are set and not empty
    if (isset($_POST['subject']) && isset($_POST['message']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
        // Retrieve student ID from the session
        $student_id = $_SESSION['user_id'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Insert query into the database
        $stmt = $db_conn->prepare("INSERT INTO student_queries (student_id, subject, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $student_id, $subject, $message);
        if ($stmt->execute()) {
            $success_message = "Query submitted successfully!";
            echo '<meta http-equiv="refresh" content="0;URL=\'student-queries.php\'" />';
            exit();
        } else {
            $error_message = "Error submitting query: " . $db_conn->error;
        }
    } else {
        $error_message = "Subject and message fields are required!";
    }
}

// Retrieve student ID from the session
$student_id = $_SESSION['user_id'];

// Retrieve student's queries from the database
$query_result = $db_conn->query("SELECT * FROM student_queries WHERE student_id = $student_id ORDER BY timestamp DESC");

?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Feedbacks/Queries</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Student</a></li>
          <li class="breadcrumb-item active">Feedbacks & Queries</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Card for submitting a query -->
        <div class="col-md-5">
            <div class="card">
                <?php if (!empty($success_message)): ?>
                    <div class="alert text-success" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($error_message)): ?>
                    <div class="alert text-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="card-header">Submit a Query</div>
                <div class="card-body">
                    <form id="message-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter your subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Card for showing submitted queries -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Your Queries</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php if ($query_result->num_rows > 0): ?>
                            <?php while ($row = $query_result->fetch_assoc()): ?>
                                <li class="list-group-item">
                                    <div class="row">
                                       
                                        <div class="col-sm-12">
                                            <strong><?php echo $row['subject']; ?></strong><br>
                                           <?php echo $row['message']; ?>
                                            <div class="mt-3">
                                                <?php
                                                // Fetch and display admin replies for this query
                                                $query_id = $row['id'];
                                                $admin_replies_result = $db_conn->query("SELECT * FROM admin_replies WHERE query_id = $query_id ORDER BY timestamp ASC");
                                                if ($admin_replies_result->num_rows > 0): ?>
                                                    <strong>Admin Replies:</strong>
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
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <li class="list-group-item">No queries submitted yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php');?>
