<?php
session_start();
function get_block_status($user_id)
{
    global $db_conn;

    // Initialize block status
    $block_status = 0;

    // Query to get the block status from the database
    $query = "SELECT blocked FROM accounts WHERE id = $user_id";

    // Execute the query
    $result = mysqli_query($db_conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the row
        $row = mysqli_fetch_assoc($result);
        
        // Check if the row exists
        if ($row) {
            // Get the block status
            $block_status = $row['blocked'];
        }
    }

    // Return the block status
    return $block_status;
}
 $site_url = 'http://localhost/final-year-project/';
  if(isset($_SESSION['login']))
  {
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'student')
    {
      $user_type = $_SESSION['user_type'];
      header('Location: /final-year-project/'.$user_type.'/dashboard.php' );
    }
  }
  else 
  {
  header('Location: ../login.php '); 
    
  }
  $std_id = $_SESSION['user_id'];
  $student = get_user_data($std_id);
  $stdmeta = get_user_metadata($std_id);
  $block_status = get_block_status($std_id);
if ($block_status == 1) {
    // User is blocked, redirect to a blocked page or display a message
    header('Location: ../blocked.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Student | Dashboard </title>
  <link rel="icon" type="image/png" href="..\assets\img\180942088_padded_logo.png" sizes="96x96" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS (assuming you are using Bootstrap) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>

  <style>
.profile-user-img {
    width: 90px; /* Adjust the width as per your preference */
    height: 90px; /* Adjust the height as per your preference */
    object-fit: cover;
    border-radius: 50%;
}

    /* Adjust the size of the "Show entries" dropdown */
    div.dataTables_wrapper .dataTables_length select {
        width: auto; /* Adjust the width as needed */
        padding: .385rem .85rem; /* Adjust padding as needed */
        font-size: 14px; /* Adjust font size as needed */
    }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">