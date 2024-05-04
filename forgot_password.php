<?php include('header.php') ?>

<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        
        <img src="assets\img\Color logo - no background.png" alt="" style="width: 80px; height:80px ; position:relative; margin-top: 30px; left: -150px;" >
      </a>

    </div>
  </header>
  <h1  class="portal"><center>Forgot Password</center></h1>
  <section class="bg-light vh-100 d-flex">
    <div class="col-3 m-auto">
        <div class="card">
            <div class="card-body">
            <?php if(isset($_GET['success']) && $_GET['success'] == 'true'): ?>
                <div class="alert alert-success" role="alert">
                    Password reset successfully!
                </div>
                <?php endif; ?>
                <h5 class="card-title text-center">Forgot Password</h5>
                <form action="actions/reset_password.php" method="POST">
                    <div class="md-form">
                        <input type="email" id="email" name="email" class="form-control" required>
                        <label for="email">Enter your Email</label>
                    </div>
                    <div class="md-form">
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                        <label for="new_password">New Password</label>
                    </div>
                    <div class="md-form">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" name="reset_password">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php') ?>