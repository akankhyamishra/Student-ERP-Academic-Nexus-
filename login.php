<?php include('header.php') ?>
<?php 
if (isset($_SESSION['error'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
  unset($_SESSION['error']); // Remove error message from session after displaying
}
?>

<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets\img\Color logo - no background.png" alt="" style="width: 80px; height:80px ; position:relative; margin-top: 30px; left: -150px;" >
        </a>
    </div>
</header>

<h1  class="portal"><center>STUDENT PORTAL</center></h1>

<section class="bg-light vh-100 d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <?php 
                if(isset($_GET['password_reset']) && $_GET['password_reset'] == 'true') {
                    echo '<div class="alert alert-success" role="alert">Password reset successfully!</div>';
                    unset($_GET['password_reset']);
                }

                if(isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
                    echo '<div class="alert alert-danger" role="alert">Invalid credentials!</div>';
                }
                ?>

                <div class="border rounded-circle mx-auto d-flex justify-content-center align-items-center" style="width:100px;height:100px">
                    <i class="fa fa-user text-light fa-3x"></i>
                </div>
                <form action="actions/login.php" method="POST">
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="text" id="email" name="email" class="form-control">
                        <label for="User-Id">Enter your ID</label>
                    </div>
                    <!-- Material input -->
                    <div class="md-form">
                        <input type="password" id="password" name="password" class="form-control">
                        <label for="password">Your Password</label>
                    </div>
                    <div class="text-center">
                        <button class="btn" name="login">Login</button>
                    </div>
                    <div id="error-msg" style="display: none; color: red;">Invalid credentials!</div> <!-- Error message div -->
                </form>
                <div class="text-center mt-3">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>
