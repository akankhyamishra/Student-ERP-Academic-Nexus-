<?php
include('../includes/config.php');

if (isset($_POST['reset_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the password
    $hashed_password = md5($password);

    // Update password in the database
    $update_query = mysqli_query($db_conn, "UPDATE `accounts` SET `password`='$hashed_password', `reset_token`=NULL WHERE `reset_token`='$token'");

    if ($update_query) {
        echo "Password reset successfully.";
    } else {
        echo "Error occurred. Please try again later.";
    }

}
?>
