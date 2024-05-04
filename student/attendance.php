<?php 
include ('../includes/config.php');
include ('header.php');
include ('sidebar.php');

// Handle form submission
if (isset($_POST['sign-in'])) {
    $std_id = $_SESSION['user_id']; // Assuming you're storing user ID in session
    $date = date("Y-m-d");
    $status = 'Present'; // Default status when the button is clicked

    // Check if it's a weekday (Monday to Friday)
    if (is_weekday($date)) {
        // Check if the student is already marked as present for today
        $sql_check = "SELECT * FROM attendance WHERE student_id = $std_id AND date = '$date'";
        $result_check = mysqli_query($db_conn, $sql_check);

        if (mysqli_num_rows($result_check) == 0) {
            // If not marked present, insert new attendance record
            $sql_insert = "INSERT INTO attendance (student_id, date, status) VALUES ('$std_id', '$date', '$status')";
            if (mysqli_query($db_conn, $sql_insert)) {
                echo '<div class="alert alert-success">Attendance marked successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error marking attendance: ' . mysqli_error($db_conn) . '</div>';
            }
        } else {
            echo '<div class="alert alert-warning">Attendance already marked for today!</div>';

            echo '<meta http-equiv="refresh" content="0;URL=\'attendance.php\'" />';
        }
    } else {
        echo '<div class="alert alert-warning">Attendance can only be marked for Monday to Friday!</div>';
    }

}

// Function to check if a given date is a weekday (Monday to Saturday)
function is_weekday($date) {
    $day_of_week = date('N', strtotime($date));
    return ($day_of_week >= 1 && $day_of_week <= 5); // Monday = 1, Saturday = 6
}

// Fetch student details
$usermeta = get_user_metadata($std_id);
$semester = get_post(['id' => $usermeta['semester']]);
$programme = get_post(['id' => $stdmeta['programme']]); ?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Student Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Student Detail</h3>
                    </div>
                   
                </div>
            </div>
            <?php
            $usermeta=get_user_metadata($std_id);
            $semester=get_post(['id'=>$usermeta['semester']])
            ?>
            <div class="card-body">
                <strong>Name: </strong> <?php echo get_users(array('id' => $std_id))[0]->name ?> <br>
                <strong>Semester: </strong> <?php echo $semester->title ?> (<?php echo $programme->title; ?>)
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">Mark Attendance</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <button name="sign-in" class="btn btn-primary">Mark</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-md-6">
                        <h3 class="card-title">Attendance</h3>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="get">
                            <div class="input-group">
                                <select class="form-control" name="month">
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch and display attendance records
                        $std_id = $_SESSION['user_id']; // Assuming you're storing user ID in session
                        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
                        $sql_attendance = "SELECT * FROM attendance WHERE student_id = $std_id AND MONTH(date) = $month";
                        $result_attendance = mysqli_query($db_conn, $sql_attendance);

                        while ($row = mysqli_fetch_assoc($result_attendance)) {
                            echo "<tr><td>{$row['date']}</td><td>{$row['status']}</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<?php include ('footer.php') ?>
