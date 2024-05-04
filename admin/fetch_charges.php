<?php
include('../includes/config.php');

if(isset($_POST['month'])) {
    $month = $_POST['month'];

    // Query to fetch charges for the specified month
    $query = "SELECT title, charge FROM monthly_charges WHERE LOWER(month) = LOWER('$month')";
    $result = mysqli_query($db_conn, $query);

    if(mysqli_num_rows($result) > 0) {
        // Start building the table to display charges
        $output = '<div class="table-responsive">';
        $output .= '<table class="table table-striped">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th>Title</th>';
        $output .= '<th>Charge</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';

        // Initialize total charge
        $totalCharge = 0;

        // Loop through each row of charges
        while($row = mysqli_fetch_assoc($result)) {
            $output .= '<tr>';
            $output .= '<td>' . $row['title'] . '</td>';
            $output .= '<td class="charge">₹' . $row['charge'] . '</td>';
            $output .= '</tr>';

            // Add charge to total
            $totalCharge += $row['charge'];
        }

        // Close the table and add total charge
        $output .= '</tbody>';
        $output .= '</table>';
        $output .= '</div>';
        $output .= '<p class="text-end mt-3">Total: ₹<strong>' . number_format($totalCharge, 2) . '</strong></p>';

        echo $output;
    } else {
        // If no charges found for the specified month, display a message
        echo '<p class="text-center">No charges available for this month</p>';
    }
}
?>
