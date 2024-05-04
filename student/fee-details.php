<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>


<?php
$success_msg = [];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
if (isset($_POST['form_submitted'])) {

    $status = isset($_POST["status"]) ? $_POST["status"] : 'success';
    $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : '';
    $amount = isset($_POST["amount"]) ? $_POST["amount"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $month = isset($_POST["month"]) ? $_POST["month"] : '';

    $title = $month . ' - Fee';

    $query = mysqli_query($db_conn, "INSERT INTO `posts` (`title`, `type`,`description`, `status`, `author`,`parent`) VALUES ('$title', 'payment','','$status', $user_id,0)");

    if ($query) {
        $item_id = mysqli_insert_id($db_conn);
    }

    $payment_data = array(
        'amount' => $amount,
        'status' => $status,
        'student_id' => $user_id,
        'month' => $month,
        'payment_date' => date('Y-m-d') // Current date
    );

    foreach ($payment_data as $key => $value) {
        mysqli_query($db_conn, "INSERT INTO `metadata` (`item_id`, `meta_key`, `meta_value`) VALUES ('$item_id', '$key', '$value')");
    }

    // Check if the payment was successful
    if ($status == 'success') {
        // Update or insert payment status in the database
        $month_lower = strtolower($month);
        $payment_status_query = mysqli_query($db_conn, "REPLACE INTO `fee_payments` (`student_id`, `month`, `status`, `payment_date`) VALUES ('$user_id', '$month_lower', '$status', '$payment_data[payment_date]')");

        // Check if the payment status was successfully updated
        if ($payment_status_query) {
            // Redirect to the same page to prevent form resubmission
            echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";
            exit;
        }
    }
}

function get_payment_status($db_conn, $user_id, $month_lower)
{
    // Retrieve payment status from the database
    $payment_status_query = mysqli_query($db_conn, "SELECT `status`, `payment_date` FROM `fee_payments` WHERE `student_id` = '$user_id' AND `month` = '$month_lower'");
    $payment_status_row = mysqli_fetch_assoc($payment_status_query);
    if ($payment_status_row) {
        return $payment_status_row; // Return both status and payment date
    } else {
        return array('status' => 'pending', 'payment_date' => ''); // Default to 'pending' status and empty payment date if no status is found
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'view-invoice') { ?>

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

<?php

} else {

?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Fee Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Student</a></li>
                        <li class="breadcrumb-item active">Fee Details</li>
                    </ol>
                </div><!-- /.col -->


            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <?php if (isset($_POST['form_submitted']) && $status == 'success') { ?>
                <div class="alert text-success" role="alert">
                    Payment has been completed, Thank You!
                </div>
            <?php } ?>

            <?php
            $usermeta = get_user_metadata($std_id);
            $semester = get_post(['id' => $usermeta['semester']]);
            $programme = get_post(['id' => $stdmeta['programme']]); ?>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Detail</h3>
                </div>
                <div class="card-body">
                <strong>Name: </strong> <?php echo get_users(array('id' => $std_id))[0]->name ?> <br>
                <strong>Class: </strong> <?php echo $semester->title ?><span> (<?php echo $programme->title; ?>)</span>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tuition Fee</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Month</th>
                                <th>Fee Status</th>
                                <th>Payment Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Define array of months
                            $months = array('1st sem', '2nd sem', '3rd sem', '4th sem', '5th sem', '6th sem', '7th sem', '8th sem');
                            foreach ($months as $key => $value) {
                                // Check if the current month is paid or pending
                                $month_lower = strtolower($value);
                                $payment_status = get_payment_status($db_conn, $user_id, $month_lower);
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
                                            <span class="badge  text-dark">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $payment_status['payment_date']; ?></td>
                                    <td>
                                        <?php if ($payment_status['status'] == 'success') : ?>
                                            <!-- Display "View" button -->
                                            <a href="?action=view-invoice&month=<?php echo urlencode($value) ?>&std_id=<?php echo $std_id ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye fa-fw"></i> View</a>
                                        <?php else : ?>
                                            <!-- Display "Pay Now" button -->
                                            <a href="#" data-toggle="modal" data-month="<?php echo ucwords($value) ?>" data-target="#paynow-popup" class="btn btn-sm btn-warning paynow-btn"><i class="fa fa-money-check-alt fa-fw"></i> Pay Now</a>
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
        </div><!--/. container-fluid -->
    </section>

    <div class="modal fade" id="paynow-popup" tabindex="-1" role="dialog" aria-labelledby="paynow-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paynow-popupLabel">Paynow</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="amount" readonly="readonly" value="500" />
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="firstname" readonly class="form-control" value="<?php echo $student->name ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" readonly class="form-control" value="<?php echo $student->email ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" readonly class="form-control" value="<?php echo $stdmeta['mother_mobile']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Semesters</label>
                                    <input type="text" name="month" readonly class="form-control" id="month" value="<?php echo $student->name ?>">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button type="submit" name="form_submitted" class="btn btn-success">Confirm & Pay</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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



<script>
    jQuery(document).on('click', '.paynow-btn', function() {
        var month = jQuery(this).data('month');
        jQuery('#month').val(month)
    })
</script>

<?php
}
include('footer.php') ?>
<script>
    $(document).ready(function() {
        $('.view-charges-btn').click(function() {
            var month = $(this).data('month');

            $.ajax({
                url: '../admin/fetch_charges.php',
                type: 'POST',
                data: { month: month },
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