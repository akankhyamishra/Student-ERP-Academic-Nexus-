<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Academic-Nexus</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <link rel="icon" type="image/png" href="assets\img\180942088_padded_logo.png" sizes="96x96" />

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>
  <?php

  include('././includes/config.php');
  

  
  $userType = isset($_REQUEST['user']) ? $_REQUEST['user'] : '';

  if(isset($_SESSION['login']))
  {
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'student')
    {
      $user_type = $_SESSION['user_type'];
      header('Location: /final-year-project/'.$user_type.'/dashboard.php' );
    }
  }
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['type'];


    // Check if a file is selected

    $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$email'");

    if (mysqli_num_rows($check_query) > 0) {
      $error = 'User ID already exists';
    } else {
      mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`type`) VALUES ('$name','$email','$type')") or die(mysqli_error($db_conn));
      $_SESSION['success_msg'] = 'User has been successfully registered';
      echo '<meta http-equiv="refresh" content="0;URL=\'login.php\'" />';
      exit();
    }
  }

  ?>


<section class="content">
  <div class="container-fluid">
    <?php if (isset($_GET['action'])) { ?>
      <header id="header" class="header fixed-top bg-white">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      
          <a href="index.php" class="logo d-flex align-items-center">
      
            <img src="assets\img\Color logo - no background.png" alt="" style="width: 1cm; height:6cm ;">
          </a>
          <nav id="navbar" class="navbar">
      
            <ul>
      
      
              <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
      
      
      
              <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>
              <?php if (isset($_SESSION['login'])) { ?>
              <?php } else { ?>
                <li><a class="getstarted scrollto" href="login.php">Sign-In</a></li>
              <?php } ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>
      
        </div>
      </header>
      <div class="card">
        <div class="card-body" id="form-container">
          <?php if ($_GET['action'] == 'register') { ?>
            <form action="" id="student-registration" method="post" enctype="multipart/form-data">
              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"><b>Student Information</b></legend>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><b>Full Name</b></label>
                      <input type="text" class="form-control" placeholder="Full Name" name="name">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>DOB</b></label>
                      <input type="date" class="form-control" placeholder="DOB" name="dob">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>Mobile</b></label>
                      <input type="text" class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>College Email</b></label>
                      <input type="email" class="form-control" placeholder="Email Address" name="email">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>Personal Email</b></label>
                      <input type="email" class="form-control" placeholder="Email Address" name="email1">
                    </div>
                  </div>

                  <!-- Address Fields -->
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><b>Address</b></label>
                      <input type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>Country</b></label>
                      <input type="text" class="form-control" placeholder="Country" name="country">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>State</b></label>
                      <input type="text" class="form-control" placeholder="State" name="state">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for=""><b>Pin/Zip Code</b></label>
                      <input type="text" class="form-control" placeholder="Pin/Zip Code" name="zip">
                    </div>
                  </div>
                </div>
              </fieldset>
              <hr>

              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"><b>Parents Information</b></legend>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><b>Father's Name</b></label>
                      <input type="text" class="form-control" placeholder="Father's Name" name="father_name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><b>Father's Mobile</b></label>
                      <input type="text" class="form-control" placeholder="Father's Mobile" name="father_mobile">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><b>Mother's Name</b></label>
                      <input type="text" class="form-control" placeholder="Mother's Name" name="mother_name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><b>Mothers's Mobile</b></label>
                      <input type="text" class="form-control" placeholder="Mothers's Mobile" name="mother_mobile">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><b>Father's Occupation</b></label>
                      <input type="text" class="form-control" placeholder="Father's Occupation" name="father_occupation">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for=""><b>Mother's Occupation</b></label>
                      <input type="text" class="form-control" placeholder="Mothers's Occupation" name="mother_occupation">
                    </div>
                  </div>
                  <!-- Address Fields -->

                </div>
              </fieldset>

              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"><b>Last Qualification</b></legend>
                <div class="row">

                  <div class="col-lg">

                    <div class="col-lg">
                      <div class="form-group">
                        <label for=""><b>10th Percentage</b></label>
                        <input type="text" class="form-control" placeholder="Percentage" name="10th_percentage">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for=""><b>University</b></label>
                        <input type="text" class="form-control" placeholder="School Name" name="school_name">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg">

                    <div class="col-lg">
                      <div class="form-group">
                        <label for=""><b>12th Percentage</b></label>
                        <input type="text" class="form-control" placeholder="Percentage" name="12th_percentage">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for=""><b>University</b></label>
                        <input type="text" class="form-control" placeholder="School Name" name="school_name2">
                      </div>
                    </div>
                  </div>



                </div>
                <div class="col-lg">
                  <div class="form-group">
                    <label for=""><b>Status</b></label>
                    <input type="text" class="form-control" placeholder="Status" name="status">
                  </div>
                </div>
              </fieldset>
<hr>
              <fieldset class="border border-secondary p-3 form-group">
                <legend class="d-inline w-auto h6"><b>Admission Details</b></legend>
                <div class="row">
                  <div class="col-lg">
                    <div class="form-group">
                      <label for=""><b>Semester</b></label>
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
                      <label for="programme"><b>Select programme</b></label>
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
                      <label for=""><b>Date of Admission</b></label>
                      <input type="date" class="form-control" placeholder="Date of Admission" name="doa">
                    </div>
                  </div>
                </div>


              </fieldset>

              <div class="form-group">
                <label for="online-payment"><input type="radio" name="payment_method" value="online" id="online-payment"> <b>Online Payment</b></label>
                <label for="offline-payment"><input type="radio" name="payment_method" value="offline" id="offline-payment"><b> Offline Payment</b></label>
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
    </div>
  </section>
<?php } else { ?>
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">

        <img src="assets\img\Color logo - no background.png" alt="" style="width: 1cm; height:6cm ;">
      </a>
      <nav id="navbar" class="navbar">

        <ul>


          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>

          <li><a class="nav-link scrollto" href="?user=student&action=register">Register</a></li>
          <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>
          <?php if (isset($_SESSION['login'])) { ?>
          <?php } else { ?>
            <li><a class="getstarted scrollto" href="login.php">Sign-In</a></li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Student Enterprise Resource Planning</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Unlock the potential of your institution: Elevate student experience with our ERP.</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="login.php" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/11788713_4799408.svg" class="img-fluid" alt="" style="z-index: 0;">
        </div>
      </div>
    </div>

  </section>

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>About</h3>
              <h2>Welcome to our ERP system – the cornerstone of modern educational management. </h2>
              <p>
                With our ERP system, you can effortlessly manage student data, track academic progress, and facilitate communication between students, faculty, and administrators. Our intuitive interface simplifies complex tasks, allowing you to focus on what truly matters – providing a superior educational experience for your students.
              </p>
              <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets\img\8609213_5853.jpg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->




  </main>

  <!-- ======= Footer ======= -->
  
<?php } ?>
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
            location.href = 'http://localhost/final-year-project/admin/user-account.php?user=student&action=fee-payment&std_id=' + response.std_id + '&payment_method=' + response.payment_method;
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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<script src="assets/js/main.js"></script>

</body>

</html>