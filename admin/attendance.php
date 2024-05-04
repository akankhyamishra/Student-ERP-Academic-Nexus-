<?php 
include ('../includes/config.php');
include ('header.php');
include ('sidebar.php');

// Fetch all students
$sql_students = "SELECT * FROM accounts WHERE type = 'student'";
$result_students = mysqli_query($db_conn, $sql_students);

// Handle form submission
if (isset($_POST['view-attendance'])) {
    $std_id = $_POST['student'];
    $month = $_POST['month'];
    $sql_attendance = "SELECT * FROM attendance WHERE student_id = $std_id AND MONTH(date) = $month";
    $result_attendance = mysqli_query($db_conn, $sql_attendance);

    // Fetch student details
    $student_details = get_users(array('id' => $std_id))[0];
}

// Handle edit attendance
if (isset($_GET['edit_attendance'])) {
    $attendance_id = $_GET['edit_attendance'];
    // Fetch the attendance record to edit
    $sql_edit_attendance = "SELECT * FROM attendance WHERE id = $attendance_id";
    $result_edit_attendance = mysqli_query($db_conn, $sql_edit_attendance);
    $edit_attendance = mysqli_fetch_assoc($result_edit_attendance);

    // Handle update attendance
    if (isset($_POST['update_attendance'])) {
        $new_status = $_POST['status'];

        // Update the attendance record
        $sql_update_attendance = "UPDATE attendance SET status = '$new_status' WHERE id = $attendance_id";
        if (mysqli_query($db_conn, $sql_update_attendance)) {
            echo '<div class="alert text-success">Attendance updated successfully!</div>';
        } else {
            echo '<div class="alert text-danger">Error updating attendance: ' . mysqli_error($db_conn) . '</div>';
        }
    }
}

// Handle delete attendance
if (isset($_GET['delete_attendance'])) {
    $attendance_id = $_GET['delete_attendance'];
    
    // Delete the attendance record
    $sql_delete_attendance = "DELETE FROM attendance WHERE id = $attendance_id";
    if (mysqli_query($db_conn, $sql_delete_attendance)) {
        echo '<div class="alert text-success">Attendance deleted successfully!</div>';
    } else {
        echo '<div class="alert text-danger">Error deleting attendance: ' . mysqli_error($db_conn) . '</div>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Select Student and Month</h3>
            </div>
            <div class="card-body">
                <!-- Form for selecting student and month -->
                <form action="attendance.php" method="post">
    <!-- Student dropdown -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="student">Select Student:</label>
            <select class="form-control" id="student" name="student">
                <?php while ($row = mysqli_fetch_assoc($result_students)) { ?>
                    <?php $selected_student = isset($_POST['student']) && $_POST['student'] == $row['id'] ? 'selected' : ''; ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $selected_student; ?>><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- Month dropdown -->
        <div class="form-group col-md-3">
            <label for="month">Select Month:</label>
            <select class="form-control" id="month" name="month">
                <?php
                $selected_month = isset($_POST['month']) ? $_POST['month'] : date('m');
                for ($m = 1; $m <= 12; $m++) {
                    $month_name = date('F', mktime(0, 0, 0, $m, 1));
                    $selected = ($m == $selected_month) ? 'selected' : '';
                    echo "<option value='$m' $selected>$month_name</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <!-- Submit button -->
    <button type="submit" name="view-attendance" class="btn btn-primary">View Attendance</button>
</form>
            </div>
        </div>

        <?php if (isset($result_attendance)) { ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attendance for <?php echo $student_details->name; ?></h3>
                </div>
                <div class="card-body">
                    <!-- Attendance table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td>Status</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_attendance)) { ?>
                                <tr>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <!-- Actions column -->
                                    <td>
                                        <!-- Edit button -->
                                        <a href="attendance.php?edit_attendance=<?php echo $row['id']; ?>" class="class="class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                        <!-- Delete button -->
                                        <a href="attendance.php?delete_attendance=<?php echo $row['id']; ?>" class="text-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>

        <!-- Form for editing attendance -->
        <?php if (isset($_GET['edit_attendance'])) { ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Attendance</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" name="status" value="<?php echo $edit_attendance['status']; ?>">
                        </div>
                        <button type="submit" name="update_attendance" class="btn btn-primary">Update Attendance</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<?php include ('footer.php') ?>
