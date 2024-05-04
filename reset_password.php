<?php include('header.php') ?>

<section class="bg-light vh-100 d-flex">
    <div class="col-3 m-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Reset Password</h5>
                <form action="actions/update_password.php" method="POST">
                    <div class="md-form">
                        <input type="password" id="password" name="password" class="form-control">
                        <label for="password">New Password</label>
                    </div>
                    <div class="md-form">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                    <div class="text-center">
                        <button class="btn btn-primary" name="reset_password">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php') ?>
