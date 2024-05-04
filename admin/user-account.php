<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php error_reporting(E_ALL);
ini_set('display_errors', 1); ?>
<?php
$error = '';


if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  password_hash($_POST['password'], PASSWORD_DEFAULT);
  $type = $_POST['type'];


  // Check if a file is selected
  if ($_FILES['profile_photo']['name']) {
    $file_name = $_FILES['profile_photo']['name'];
    $file_size = $_FILES['profile_photo']['size'];
    $file_tmp = $_FILES['profile_photo']['tmp_name'];
    $file_type = $_FILES['profile_photo']['type'];
    $file_name_parts = explode('.', $_FILES['profile_photo']['name']);
    $file_ext = strtolower(end($file_name_parts));


    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
      $error = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
      $error = 'File size must be less than 2 MB';
    }

    if (empty($error) == true) {
      move_uploaded_file($file_tmp, "../uploads/" . $file_name);
      $image_path = "../uploads/" . $file_name;
    } else {
      echo $error;
      exit; // Exit if there's an error with file upload
    }
  }

  $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$email'");

  if (mysqli_num_rows($check_query) > 0) {
    $error = 'User ID already exists';
  } else {
    mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`password`,`type`,`image_path`) VALUES ('$name','$email','$password','$type','$image_path')") or die(mysqli_error($db_conn));
    $_SESSION['success_msg'] = 'User has been successfully registered';
    echo '<meta http-equiv="refresh" content="0;URL=\'user-account?user=student.php\'" />';
    exit();
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
  $delete_id = isset($_POST['delete_id']) ? $_POST['delete_id'] : null;

  if ($delete_id) {
    // Delete user from accounts table
    $delete_user_query = "DELETE FROM accounts WHERE id = $delete_id";
    $delete_user_result = mysqli_query($db_conn, $delete_user_query);

    // Delete user's metadata from usermeta table
    $delete_metadata_query = "DELETE FROM usermeta WHERE user_id = $delete_id";
    $delete_metadata_result = mysqli_query($db_conn, $delete_metadata_query);

    if ($delete_user_result && $delete_metadata_result) {
      echo '<div class="alert text-success">User deleted successfully.</div>';
      echo '<script>window.location.href = "user-account.php?user=student";</script>';
      exit();
    } else {
      echo '<div class="alert alert-danger">Failed to delete user and metadata. Please try again.</div>';
    }
  } else {
    echo '<div class="alert alert-danger">Error: User ID is not provided.</div>';
  }
}
$userType = isset($_REQUEST['user']) ? $_REQUEST['user'] : '';
if (isset($_POST['block_user'])) {
  $user_id = $_POST['user_id'];
  $block_status = $_POST['block_status'];

  // Toggle the block status
  $new_block_status = ($block_status == 1) ? 0 : 1;

  // Update the block status in the database
  $update_query = "UPDATE accounts SET blocked = $new_block_status WHERE id = $user_id";
  $update_result = mysqli_query($db_conn, $update_query);

  if ($update_result) {
      // Block status updated successfully
      echo '<div class="alert alert-success">User block status updated successfully.</div>';
      echo '<meta http-equiv="refresh" content="0;URL=\'user-account.php\'" />';
      exit();
  } else {
      // Error updating block status
      echo '<div class="alert alert-danger">Failed to update user block status. Please try again.</div>';
  }
}
?>


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Manage Accounts</h1><br>

      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Accounts</a></li>
          <li class="breadcrumb-item active">Students</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

</div>

<section class="content">
  <div class="container-fluid">
    <?php if (isset($_GET['action'])) { ?>
      <div class="card">
        <div class="card-body" id="form-container">
          <?php if ($_GET['action'] == 'add-new') { ?>
            <form action="" id="student-registration" method="post" enctype="multipart/form-data">
              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6">Student Information</legend>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Full Name</label>
                      <input type="text" class="form-control" placeholder="Full Name" name="name">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">DOB</label>
                      <input type="date" class="form-control" placeholder="DOB" name="dob">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Mobile</label>
                      <input type="text" class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">College Email</label>
                      <input type="email" class="form-control" placeholder="Email Address" name="email">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Personal Email</label>
                      <input type="email" class="form-control" placeholder="Email Address" name="email1">
                    </div>
                  </div>

                  <!-- Address Fields -->
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="">Address</label>
                      <input type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Country</label>
                      <input type="text" class="form-control" placeholder="Country" name="country">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">State</label>
                      <input type="text" class="form-control" placeholder="State" name="state">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Pin/Zip Code</label>
                      <input type="text" class="form-control" placeholder="Pin/Zip Code" name="zip">
                    </div>
                  </div>
                </div>
              </fieldset>

              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6">Parents Information</legend>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Father's Name</label>
                      <input type="text" class="form-control" placeholder="Father's Name" name="father_name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Father's Mobile</label>
                      <input type="text" class="form-control" placeholder="Father's Mobile" name="father_mobile">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Mother's Name</label>
                      <input type="text" class="form-control" placeholder="Mother's Name" name="mother_name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Mothers's Mobile</label>
                      <input type="text" class="form-control" placeholder="Mothers's Mobile" name="mother_mobile">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Father's Occupation</label>
                      <input type="text" class="form-control" placeholder="Father's Occupation" name="father_occupation">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Mother's Occupation</label>
                      <input type="text" class="form-control" placeholder="Mothers's Occupation" name="mother_occupation">
                    </div>
                  </div>
                  <!-- Address Fields -->

                </div>
              </fieldset>

              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6">Last Qualification</legend>
                <div class="row">

                  <div class="col-lg">

                    <div class="col-lg">
                      <div class="form-group">
                        <label for="">10th Percentage</label>
                        <input type="text" class="form-control" placeholder="Percentage" name="10th_percentage">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="">University</label>
                        <input type="text" class="form-control" placeholder="School Name" name="school_name">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg">

                    <div class="col-lg">
                      <div class="form-group">
                        <label for="">12th Percentage</label>
                        <input type="text" class="form-control" placeholder="Percentage" name="12th_percentage">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="">University</label>
                        <input type="text" class="form-control" placeholder="School Name" name="school_name2">
                      </div>
                    </div>
                  </div>



                </div>
                <div class="col-lg">
                  <div class="form-group">
                    <label for="">Status</label>
                    <input type="text" class="form-control" placeholder="Status" name="status">
                  </div>
                </div>
              </fieldset>

              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6">Admission Details</legend>
                <div class="row">
                  <div class="col-lg">
                    <div class="form-group">
                      <label for="">Semester</label>
                      <!-- <input type="text" class="form-control" placeholder="Class" name="class"> -->
                      <select name="semester" id="semester" class="form-control">
                        <option value="">Select Class</option>
                        <?php
                        $args = array(
                          'type' => 'class',
                          'status' => 'publish',
                        );
                        $classes = get_posts($args);
                        foreach ($classes as $class) {
                          echo '<option value="' . $class->id . '">' . $class->title . '</option>';
                        } ?>

                      </select>

                    </div>
                  </div>
                  <div class="col-lg">
                    <div class="form-group" id="programme-container">
                      <label for="programme">Select programme</label>
                      <select require name="programme" id="programme" class="form-control">
                        <option value="">-Select programme-</option>
                        <?php
                        $args = array(
                          'type' => 'programme',
                          'status' => 'publish',
                        );
                        $programmes = get_posts($args);
                        foreach ($programmes as $programme) {
                          $selected = ($programme_id == $programme->id) ? 'selected' : '';
                          echo '<option value="' . $programme->id . '" ' . $selected . '>' . $programme->title . '</option>';
                        } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg">
                    <div class="form-group">
                      <label for="">Date of Admission</label>
                      <input type="date" class="form-control" placeholder="Date of Admission" name="doa">
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <label for="profile-photo">Profile Photo</label>
                  <input type="file" class="form-control-file" id="profile-photo" name="profile_photo">
                </div>

              </fieldset>

              <div class="form-group">
                <label for="online-payment"><input type="radio" name="payment_method" value="online" id="online-payment"> Online Payment</label>
                <label for="offline-payment"><input type="radio" name="payment_method" value="offline" id="offline-payment"> Offline Payment</label>
              </div>
              <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
              <button type="submit" name="submit" class="btn btn-primary"><span id="loader" style='display:none'><i class="fas fa-circle-notch fa-spin"></i></span> Register</button>
            </form>
          <?php } elseif ($_GET['action'] == 'fee-payment') { ?>
            <form action="" id="registration-fee" method="post">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">Reciept Number</label>
                    <input type="text" name="reciept_number" placeholder="Reciept Number" class="form-control">
                  </div>

                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">Registration Fee</label>
                    <input type="text" name="registration_fee" placeholder="Registration Fee" class="form-control">
                  </div>
                </div>


              </div>
              <input type="hidden" name="std_id" value="<?php echo isset($_GET['std_id']) ? $_GET['std_id'] : '' ?>">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          <?php } ?>
        </div>
      </div>

    <?php } else { ?>
      <!-- Info boxes -->
      <div class="card">
        <div class="card-header py-2">
          <h3 class="card-title">
            <?php echo ucfirst($userType) ?>
          </h3>
          <div class="card-tools">
            <a href="?user=<?php echo $userType ?>&action=add-new" class="btn btn-success btn-sm"><i class="fa fa-plus mr-2"></i>Add New</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive bg-white">
            <table class="table table-bordered" id="users-table" width="100%">
              <thead>
                <tr>
                  <th width="50">S.no.</th>
                  <th>Name</th>
                  <th>email</th>
                  <th>userID</th>
                  <th>Image</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
$users = null;
                $count = 1;
                $user_query = 'SELECT * FROM accounts WHERE `type`="' . $userType . '"';
                $user_result = mysqli_query($db_conn, $user_query);
                while ($users = mysqli_fetch_object($user_result)) {

                ?>
                  <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $users->name ?></td>
                    <td><?= $users->email ?></td>
                    <td><?= $users->userID ?></td>
                    <td> <?php if (!empty($users->image_path)) { ?>
                        <img src="<?= $users->image_path ?>" alt="Student Image" style="width: 50px; height: auto;">
                      <?php } else { ?>
                        <i class="fas fa-user fa-light" style="font-size: 24px;"></i> <!-- Font Awesome user icon -->
                      <?php } ?>
                    <td>
                      <a href="view-profile.php?id=<?= $users->id ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View Profile</a>
                      <form action="" method="post" style="display: inline;">
                        <input type="hidden" name="delete_id" value="<?= $users->id ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user and their associated metadata?');" name="delete"><i class="fa fa-trash"></i> Delete</button>
                      </form>
                      <form action="" method="post" style="display: inline;">
            <input type="hidden" name="user_id" value="<?= $users->id ?>">
            <input type="hidden" name="block_status" value="<?= $users->blocked ?? 0 ?>">
            <?php
            $button_text = isset($users->blocked) && $users->blocked == 1 ? "Unblock" : "Block";
            $button_class = isset($users->blocked) && $users->blocked == 1 ? "btn btn-success btn-sm" : "btn btn-dark btn-sm";
            ?>
            <button type="submit" class="<?= $button_class ?>" name="block_user"><i class="fas fa-ban"></i><?= $button_text ?></button>
        </form>

                    </td>

                  </tr>
                <?php } ?>
              </tbody>

            </table>

          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php } ?>
    <!-- Small boxes (Stat box) -->

  </div>
</section>
<script>
$(document).ready(function() {
  $('#users-table').DataTable();
});
</script>
<script>
  
  jQuery('#student-registration').on('submit', function() {
    console.log();
    if (true) {
      var formdata = jQuery(this).serialize();

      jQuery.ajax({
        type: "post",
        url: "../actions/student-registration.php",
        data: formdata,
        dataType: 'json',
        beforeSend: function() {
          jQuery('#loader').show();
        },
        success: function(response) {
          console.log(response);
          if (response.success == true) {
            location.href = 'user-account.php?user=student&action=fee-payment&std_id=' + response.std_id + '&payment_method=' + response.payment_method;
          }
        },
        complete: function() {
          // jQuery('#loader').hide();
        }
      });
    }
    return false;
  });
</script>



<?php include('footer.php') ?>