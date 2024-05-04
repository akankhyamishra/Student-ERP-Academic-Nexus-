<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Student Fee Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Student Fee Details</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if (isset($_GET['action']) && $_GET['action'] == 'view') {
            $std_id = isset($_GET['std_id']) ? $_GET['std_id'] : '';
            $usermeta = get_user_metadata($std_id);
            $semester = get_post(['id' => $usermeta['semester']]);
        ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Detail</h3>
                </div>
                <div class="card-body">
                    <strong>Name: </strong> <?php echo get_users(array('id' => $std_id))[0]->name ?> <br>
                    <strong>Class: </strong> <?php echo $semester->title ?>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fees</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Semester</th>
                                <th>Fee Status</th>
                                <th>Last Payment Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $months = array('1st Sem', '2nd Sem', '3rd Sem', '4th Sem', '5th Sem', '6th Sem', '7th Sem', '8th Sem');
                            foreach ($months as $key => $value) {
                                // Check if the current month is paid or pending
                                $month_lower = strtolower($value);
                                $payment_status = get_payment_status($db_conn, $std_id, $month_lower);
                            ?>
                                <tr <?php if ($payment_status['status'] == 'success') echo 'class="table-success"'; ?>>
                                    <td><?php echo ++$key ?></td>
                                    <td><?php echo ucwords($value) ?></td>
                                    <td>
                                        <?php if ($payment_status['status'] == 'success') : ?>
                                            <!-- Display "Paid" status -->
                                            <span class="badge bg-success">Paid</span>
                                        <?php else : ?>
                                            <!-- Display "Pending" status -->
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $payment_status['payment_date']; ?></td>
                                    <td>
                                        <?php if ($payment_status['status'] == 'success') : ?>
                                            <!-- If payment is paid, show view button -->
                                            <a href="?action=view-invoice&month=<?php echo $value ?>&std_id=<?php echo $std_id ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye fa-fw"></i> View</a>
                                        <?php else : ?>
                                            <!-- If payment is pending, show view charges button -->
                                            <button type="button" class="btn btn-info view-charges-btn btn-sm" data-toggle="modal" data-target="#view-charges-popup" data-month="1st sem"><i class="fa fa-eye fa-fw"></i>
                                                View Charges
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php } elseif (isset($_GET['action']) && $_GET['action'] == 'view-invoice') { ?>
            <?php
            $selected_month = isset($_GET['month']) ? $_GET['month'] : '';
            $std_id = isset($_GET['std_id']) ? $_GET['std_id'] : '';
            $usermeta = get_user_metadata($std_id);
            $user_name = get_users(array('id' => $std_id))[0]->name;
            $semester = get_post(['id' => $usermeta['semester']]);

            $payment_date_query = mysqli_query($db_conn, "SELECT payment_date FROM fee_payments WHERE student_id = '$std_id' AND month = '$selected_month'");
            $payment_date_row = mysqli_fetch_assoc($payment_date_query);
            $payment_date = ($payment_date_row) ? date('Y-m-d', strtotime($payment_date_row['payment_date'])) : 'Not Paid';
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-15">Invoice #DS0204 <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                    <div class="mb-4">
                                        <h2 class="mb-1 text-muted">PayUbiz</h2>
                                    </div>
                                    <div class="text-muted">
                                        <p class="mb-1">Gothapatana, 751006</p>
                                        <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-muted">
                                            <h5 class="font-size-16 mb-3">Billed To:</h5>
                                            <h5 class="font-size-15 mb-2">wiz@gmail.com</h5>
                                            <p class="mb-1">IIIT Bhubaneswar</p>
                                            <p>001-234-5678</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-muted text-sm-end">
                                            <div>
                                                <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                                <p>#DZ0112</p>
                                            </div>
                                            <div class="mt-4">
                                                <h5 class="font-size-15 mb-1">Semester:</h5>
                                                <p>
                                                    <td><?php echo $selected_month; ?></td>
                                                </p>
                                            </div>
                                            <div class="mt-4">
                                                <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                                <td><?php echo $payment_date; ?></td>
                                            </div>

                                            <div class="mt-4">
                                                <h5 class="font-size-15 mb-1">Payed By:</h5>
                                                <p>
                                                    <td><?php echo $user_name; ?></td>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="py-2">
                                    <h5 class="font-size-15">Summary</h5>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Title</th>
                                                    <th>Charge</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Fetch charges for the selected month
                                                $selected_month = isset($_GET['month']) ? $_GET['month'] : '';
                                                $charges_query = mysqli_query($db_conn, "SELECT * FROM monthly_charges WHERE month = '$selected_month'");
                                                $total_charge = 0;
                                                $count = 0;
                                                while ($charge_row = mysqli_fetch_assoc($charges_query)) {
                                                    $count++;
                                                    $total_charge += $charge_row['charge'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo $charge_row['title']; ?></td>
                                                        <td><?php echo '₹' . $charge_row['charge']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-end">Total</th>
                                                    <th><?php echo '₹' . $total_charge; ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div><!-- end table responsive -->
                                    <div class="d-print-none mt-4">
                                        <div class="float-end">
                                            <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                            <a href="#" class="btn btn-primary w-md">Send</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
            </div>
        <?php } else { ?>
            <table id="student-fees-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.no.</th>
                        <th>Student Name</th>

                        <th>Last Payment</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $months = array('1st Sem', '2nd Sem', '3rd Sem', '4th Sem', '5th Sem', '6th Sem', '7th Sem', '8th Sem');

                    $students = get_users(array('type' => 'student'));
                    foreach ($students as $key => $student) {
                        $last_payment = '';
                        $due_payment = '';

                        // Fetch the months for which the student has made payments
                        $payment_query = mysqli_query($db_conn, "SELECT  `month` FROM `fee_payments` WHERE `student_id` = '$student->id' AND `status` = 'success'");
                        $paid_months = array();
                        while ($payment_row = mysqli_fetch_assoc($payment_query)) {
                            $paid_months[] = $payment_row['month'];
                        }

                        // Determine the pending months
                        $pending_months = array_diff($months, $paid_months);
                        $due_payment = implode(', ', $pending_months);

                        // Fetch the last payment date
                        $last_payment_query = mysqli_query($db_conn, "SELECT MAX(payment_date) AS last_payment FROM fee_payments WHERE student_id = $student->id");
                        $last_payment_row = mysqli_fetch_assoc($last_payment_query);
                        if ($last_payment_row['last_payment']) {
                            $last_payment = date('Y-m-d', strtotime($last_payment_row['last_payment']));
                        }
                    ?>
                        <tr>

                            <td><?php echo ++$key ?></td>
                            <td><?php echo $student->name ?></td>

                            <td><?php echo $last_payment ?></td>

                            </td>
                            <td>
                                <a href="?action=view&std_id=<?php echo $student->id ?>" class="btn btn-sm btn-info"><i class="fa fa-eye fa-fw"></i> View</a>
                                <a href="?action=view-invoice&std_id=<?php echo $student->id ?>" class="btn btn-sm btn-dark"><i class="fa fa-pencil-alt fa-fw"></i>View Invoice</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div><!--/. container-fluid -->
</section>
<!-- Modal -->
<div class="modal fade" id="view-charges-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Charges Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Charges will be dynamically added here -->
                <div id="charges-table"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- /.content -->
<?php include('footer.php') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



<?php
// Function to get payment status
function get_payment_status($db_conn, $std_id, $month)
{
    $payment_status = array(
        'status' => 'pending',
        'payment_date' => ''
    );
    $sql = "SELECT * FROM fee_payments WHERE student_id = $std_id AND month = '$month' LIMIT 1";
    $result = mysqli_query($db_conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $payment_status['status'] = 'success';
        $payment_status['payment_date'] = date('Y-m-d', strtotime($row['payment_date']));
    }
    return $payment_status;
}
?>

<script>
    $(document).ready(function() {
        $('.view-charges-btn').click(function() {
            var month = $(this).data('month');

            $.ajax({
                url: 'fetch_charges.php',
                type: 'POST',
                data: {
                    month: month
                },
                success: function(response) {
                    $('#charges-table').html(response);

                    // Calculate total charge
                    var totalCharge = 0;
                    $('.charge').each(function() {
                        var charge = parseFloat($(this).text().replace('₹', ''));
                        totalCharge += charge;
                    });

                    // Update total charge in modal
                    $('#total-charge').text('<strong>Total Charge: ₹' + totalCharge.toFixed(2) + '</strong>');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#student-fees-table').DataTable();
    });
</script>