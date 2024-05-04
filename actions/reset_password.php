<?php
session_start();
include('../includes/config.php');

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit();
    }

    // Check if email exists in the database
    $query = mysqli_query($db_conn, "SELECT * FROM `accounts` WHERE `email`='$email'");
    if(mysqli_num_rows($query) > 0) {
        // Hash the new password
        $new_password_md5 = md5($new_password);

        // Update the password in the database
        $update_query = mysqli_query($db_conn, "UPDATE `accounts` SET `password`='$new_password_md5' WHERE `email`='$email'");
        
        if($update_query) {
            header("Location: ../login.php?password_reset=true");
            exit();
        } else {
            echo "Failed to reset password. Please try again later.";
        }
    } else {
        echo "Email not found. Please enter a valid email address.";
    }
}


?>
