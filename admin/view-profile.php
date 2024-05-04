<?php 
include ('../includes/config.php');
include ('header.php');
include ('sidebar.php');

$student_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($student_id) {
    // Retrieve student data and metadata
    $student = get_user_data($student_id);
    $stdmeta = get_user_metadata($student_id);
} else {
    echo "Error: Student ID is not provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve form data
    $name = $_POST['name'];
  $dob = $_POST['dob'];
  $mobile = $_POST['mobile'];
  $email1 = $_POST['email1'];
  $address = $_POST['address'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $zip = $_POST['zip'];
  $tenth_percentage = $_POST['10th_percentage'];
  $school_name = $_POST['school_name'];
  $twelveth_percentage = $_POST['12th_percentage'];
  $school_name2 = $_POST['school_name2'];
  $father_name = $_POST['father_name'];
  $mother_name = $_POST['mother_name'];
  $mother_mobile = $_POST['mother_mobile'];
  $father_occupation = $_POST['father_occupation'];
  $mother_occupation = $_POST['mother_occupation'];


  $update_query_dob = "UPDATE usermeta SET meta_value = '$dob' WHERE meta_key = 'dob' AND user_id = $student_id";
  $update_query_mobile = "UPDATE usermeta SET meta_value = '$mobile' WHERE meta_key = 'mobile' AND user_id = $student_id";
  $update_query_email1 = "UPDATE usermeta SET meta_value = '$email1' WHERE meta_key = 'email1' AND user_id = $student_id";
  $update_query_address = "UPDATE usermeta SET meta_value = '$address' WHERE meta_key = 'address' AND user_id = $student_id";
  $update_query_state = "UPDATE usermeta SET meta_value = '$state' WHERE meta_key = 'state' AND user_id = $student_id";
  $update_query_country = "UPDATE usermeta SET meta_value = '$country' WHERE meta_key = 'country' AND user_id = $student_id";
  $update_query_zip = "UPDATE usermeta SET meta_value = '$zip' WHERE meta_key = 'zip' AND user_id = $student_id";
  $update_query_tenth_percentage = "UPDATE usermeta SET meta_value = '$tenth_percentage' WHERE meta_key = '10th_percentage' AND user_id = $student_id";
  $update_query_school_name = "UPDATE usermeta SET meta_value = '$school_name' WHERE meta_key = 'school_name' AND user_id = $student_id";
  $update_query_twelveth_percentage = "UPDATE usermeta SET meta_value = '$twelveth_percentage' WHERE meta_key = '12th_percentage' AND user_id = $student_id";
  $update_query_school_name2 = "UPDATE usermeta SET meta_value = '$school_name2' WHERE meta_key = 'school_name2' AND user_id = $student_id";
  $update_query_father_name = "UPDATE usermeta SET meta_value = '$father_name' WHERE meta_key = 'father_name' AND user_id = $student_id";
  $update_query_mother_name = "UPDATE usermeta SET meta_value = '$mother_name' WHERE meta_key = 'mother_name' AND user_id = $student_id";
  $update_query_mother_mobile = "UPDATE usermeta SET meta_value = '$mother_mobile' WHERE meta_key = 'mother_mobile' AND user_id = $student_id";
  $update_query_father_occupation = "UPDATE usermeta SET meta_value = '$father_occupation' WHERE meta_key = 'father_occupation' AND user_id = $student_id";
  $update_query_mother_occupation = "UPDATE usermeta SET meta_value = '$mother_occupation' WHERE meta_key = 'mother_occupation' AND user_id = $student_id";

  // Execute each update query separately
  $update_result_dob = mysqli_query($db_conn, $update_query_dob);
  $update_result_mobile = mysqli_query($db_conn, $update_query_mobile);
  $update_result_email1 = mysqli_query($db_conn, $update_query_email1);
  $update_result_address = mysqli_query($db_conn, $update_query_address);
  $update_result_country = mysqli_query($db_conn, $update_query_country);
  $update_result_state = mysqli_query($db_conn, $update_query_state);
  $update_result_zip = mysqli_query($db_conn, $update_query_zip);
  $update_result_tenth_percentage = mysqli_query($db_conn, $update_query_tenth_percentage);
  $update_result_school_name = mysqli_query($db_conn, $update_query_school_name);
  $update_result_twelveth_percentage = mysqli_query($db_conn, $update_query_twelveth_percentage);
  $update_result_school_name2 = mysqli_query($db_conn, $update_query_school_name2);
  $update_result_father_name = mysqli_query($db_conn, $update_query_father_name);
  $update_result_mother_name = mysqli_query($db_conn, $update_query_mother_name);
  $update_result_mother_mobile = mysqli_query($db_conn, $update_query_mother_mobile);
  $update_result_father_occupation = mysqli_query($db_conn, $update_query_father_occupation);
  $update_result_mother_occupation = mysqli_query($db_conn, $update_query_mother_occupation);

  // Check if update was successful
  if (
    $update_result_dob && $update_result_mobile && $update_result_email1 && $update_result_address &&
    $update_result_country && $update_result_state && $update_result_zip && $update_result_tenth_percentage &&
    $update_result_school_name && $update_result_twelveth_percentage && $update_result_school_name2 &&
    $update_result_father_name && $update_result_mother_name && $update_result_mother_mobile &&
    $update_result_father_occupation && $update_result_mother_occupation
  ) {
    echo '<div class="alert alert-success">Profile updated successfully.</div>';
    echo '<script>window.location.href = "view-profile.php?id=' . $student_id . '";</script>';

    exit();
  } else {
    echo '<div class="alert alert-danger">Failed to update profile. Please try again.</div>';
  }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Student</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <form action="" id="student-registration" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-3">

              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                  <?php if (!empty($student->image_path)): ?>
              <img class="profile-user-img img-fluid img-circle" src="<?php echo $student->image_path; ?>" alt="User profile picture">
        <?php else: ?>
              <i class="fas fa-user-circle fa-5x"></i>
        <?php endif; ?>                    <!-- Edit button for profile picture -->
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group mt-2 row justify-content-center">
                        <div class="col-auto">
                          <?php
                          if (isset($_POST['uploadImage'])) {
                            // File upload directory
                            $targetDir = "../uploads/";
                            $fileName = basename($_FILES["profileImage"]["name"]);
                            $targetFilePath = $targetDir . $fileName;
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                            // Allow certain file formats
                            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                            if (in_array($fileType, $allowTypes)) {
                              // Upload file to server
                              if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFilePath)) {
                                // Update image_path in the database
                                $updateImagePathQuery = "UPDATE accounts SET image_path = '$targetFilePath' WHERE id = $std_id";
                                $result = mysqli_query($db_conn, $updateImagePathQuery);

                              }
                            }
                          }
                          ?>
                          <input type="file" class="form-control-file" id="profileImage" name="profileImage" style="display: none;">
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  <h3 class="profile-username text-center"><?php echo $student->name; ?></h3>
                  <p class="text-muted text-center"><?php echo $student->userID; ?></p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <?php
                    $semester = get_post(['id' => $stdmeta['semester']]);
                    $programme = get_post(['id' => $stdmeta['programme']]); ?>

                    <li class="list-group-item">
                      <b>Semester</b><a class="float-right"><?php echo $semester->title; ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Programme</b><a class="float-right" style="width: 100px;"><?php echo $programme->title; ?></a>
                    </li>
                  </ul>
                  <hr>

                </div>

              </div>


            </div>

            <div class="col-md-9">
              <div class="card card-dark">

                <div class="card-header">
                  <h3 class="card-title">Personal Information</h3>
                </div>
                <div class="card-header py-2">

                  <div class="card-tools">
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit mr-2"></i>Edit</a>
                  </div>
                </div>

                <div class="card-body">

                  <strong><i class="fas fa-phone mr-1"></i>Phone Number</strong>
                  <p class="text-muted">
                    <?php echo $stdmeta['mobile']; ?>
                  </p>
                  <hr>
                  <strong><i class="fas fa-map-marker-alt mr-1"></i>Address</strong>
                  <p class="text-muted"><?php echo $stdmeta['address']; ?>, <?php echo $stdmeta['state']; ?>,
                    <?php echo $stdmeta['country']; ?>,
                    (<?php echo $stdmeta['zip']; ?>)
                  </p>
                  <hr>
                  <strong><i class="fas fa-envelope mr-1"></i>E-mail</strong>
                  <p class="text-muted"><?php echo $stdmeta['email1']; ?></p>
                  <hr>
                  <?php
                  $usermeta = get_user_metadata($std_id);
                  ?>
                  <strong><i class="fas fa-envelope mr-1 display-hidden"></i>College E-mail</strong>
                  <p class="text-muted"><?php echo get_users(array('id' => $std_id))[0]->email ?></p>
                  <hr>
                  <strong><i class="fas fa-child mr-1 display-hidden"></i>Date Of Birth</strong>
                  <p class="text-muted"><?php echo $stdmeta['dob']; ?></p>
                  <hr>
                  <strong><i class="far fa-building mr-1"></i>College</strong>
                  <p class="text-muted">IIIT Bhubaneswar</p>
                </div>

              </div>

              <div class="card card-dark">
                <div class="card-header">
                  <h3 class="card-title">Last Qualification</h3>
                </div>

                <div class="card-body">
                  <strong><i class="fas fa-phone mr-1"></i>10th Percentage</strong>
                  <p class="text-muted">
                    <?php echo $stdmeta['10th_percentage']; ?>
                  </p>
                  <strong><i class="far fa-building mr-1"></i>University</strong>
                  <p class="text-muted"><?php echo $stdmeta['school_name']; ?></p>
                  <hr>
                  <strong><i class="fas fa-map-marker-alt mr-1"></i>12th Percentage</strong>
                  <p class="text-muted"><?php echo $stdmeta['12th_percentage']; ?></p>

                  <strong><i class="far fa-building mr-1"></i>University</strong>
                  <p class="text-muted"><?php echo $stdmeta['school_name2']; ?></p>
                  <hr>
                </div>

              </div>

              <div class="card card-dark">
                <div class="card-header">
                  <h3 class="card-title">Parent's Information</h3>
                </div>

                <div class="card-body">
                  <strong><i class="fas fa-person mr-1"></i>Father's Name</strong>
                  <p class="text-muted">
                    <?php echo $stdmeta['father_name']; ?>
                  </p>
                  <hr>
                  <strong><i class="fas fa-person-dress mr-1"></i>Mother's Name</strong>
                  <p class="text-muted"><?php echo $stdmeta['mother_name']; ?>
                  </p>
                  <hr>
                  <strong><i class="fas fa-mobile mr-1"></i>Parent's Phone Number</strong>
                  <p class="text-muted">
                    <?php echo $stdmeta['mother_mobile']; ?>

                  </p>
                  <hr>
                  <strong><i class="fas fa-briefcase mr-1"></i>Father's Occupation</strong>
                  <p class="text-muted"><?php echo $stdmeta['father_occupation']; ?></p>

                  <strong><i class="fas fa-briefcase mr-1"></i>Mother's Occupation</strong>
                  <p class="text-muted"><?php echo $stdmeta['mother_occupation']; ?></p>
                </div>

              </div>
            </div>
          </div>
        </form>



      </div><!--/. container-fluid -->
</section>
    <!-- /.content -->
<!-- Edit Profile Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <!-- Form fields for editing student information -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $student->name; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $stdmeta['dob']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $stdmeta['mobile']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email1">Personal Email</label>
                        <input type="text" class="form-control" id="email1" name="email1" value="<?php echo $stdmeta['email1']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $stdmeta['address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="<?php echo $stdmeta['state']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?php echo $stdmeta['country']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $stdmeta['zip']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="10th_percentage">10th Percentage</label>
                        <input type="text" class="form-control" id="10th_percentage" name="10th_percentage" value="<?php echo $stdmeta['10th_percentage']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="school_name">School Name (10th)</label>
                        <input type="text" class="form-control" id="school_name" name="school_name" value="<?php echo $stdmeta['school_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="12th_percentage">12th Percentage</label>
                        <input type="text" class="form-control" id="12th_percentage" name="12th_percentage" value="<?php echo $stdmeta['12th_percentage']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="school_name2">School Name (12th)</label>
                        <input type="text" class="form-control" id="school_name2" name="school_name2" value="<?php echo $stdmeta['school_name2']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_name">Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $stdmeta['father_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_name">Mother's Name</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?php echo $stdmeta['mother_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_mobile">Mother's Mobile</label>
                        <input type="text" class="form-control" id="mother_mobile" name="mother_mobile" value="<?php echo $stdmeta['mother_mobile']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_occupation">Father's Occupation</label>
                        <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="<?php echo $stdmeta['father_occupation']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_occupation">Mother's Occupation</label>
                        <input type="text" class="form-control" id="mother_occupation" name="mother_occupation" value="<?php echo $stdmeta['mother_occupation']; ?>">
                    </div>

                    <!-- Add other form fields similarly -->

                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

</section>
<!-- /.content -->
<?php include ('footer.php') ?>
