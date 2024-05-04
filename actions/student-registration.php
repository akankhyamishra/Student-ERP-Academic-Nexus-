<?php
include ('../includes/config.php');


if (isset($_POST['type']) && $_POST['type'] == 'student' && isset($_POST['email']) && !empty($_POST['email'])) {


    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $email1 = isset($_POST['email1']) ? $_POST['email1'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
    $password = date('dmY', strtotime($dob));
    $md_password = md5($password);

    $father_name = isset($_POST['father_name']) ? $_POST['father_name'] : '';
    $father_occupation = isset($_POST['father_occupation']) ? $_POST['father_occupation'] : '';
    $mother_occupation = isset($_POST['mother_occupation']) ? $_POST['mother_occupation'] : '';
    $father_mobile = isset($_POST['father_mobile']) ? $_POST['father_mobile'] : '';
    $mother_name = isset($_POST['mother_name']) ? $_POST['mother_name'] : '';
    $mother_mobile = isset($_POST['mother_mobile']) ? $_POST['mother_mobile'] : '';


    $school_name = isset($_POST['school_name']) ? $_POST['school_name'] : '';
    $school_name2 = isset($_POST['school_name2']) ? $_POST['school_name2'] : '';

    $tenth_percentage = isset($_POST['10th_percentage']) ? $_POST['10th_percentage'] : '';
    $twelveth_percentage = isset($_POST['12th_percentage']) ? $_POST['12th_percentage'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
    $programme = isset($_POST['programme']) ? $_POST['programme'] : '';

   // $profile_photo = isset($_POST['profile_photo']) ? $_POST['profile_photo'] : '';
    $doa = isset($_POST['doa']) ? $_POST['doa'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $date_add = date('Y-m-d');


    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    
 
    $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$email'");
    if (mysqli_num_rows($check_query) > 0) {
        // $error = 'Email already exists';
        echo 'Email already exists';
        die;
    } else {
        $query = mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`password`,`type`) VALUES ('$name','$email','$md_password','$type')") or die(mysqli_error($db_conn));
        if ($query) {
            $user_id = mysqli_insert_id($db_conn);
        }
    }

    $usermeta = array(
        'dob' => $dob,
        'mobile' => $mobile,
        'payment_method' => $payment_method,
        'semester' => $semester,
        'email1' => $email1,
        'address' => $address,
        'country' => $country,
        'state' => $state,
        'zip' => $zip,
        'father_name' => $father_name,
        'father_occupation' => $father_occupation,
        'father_mobile' => $father_mobile,
        'mother_occupation' => $mother_occupation,
        'mother_name' => $mother_name,
        'mother_mobile' => $mother_mobile,
        //'profile_photo' => $profile_photo,
        'school_name' => $school_name,
        'school_name2' => $school_name2,
        '10th_percentage' => $tenth_percentage,
        '12th_percentage' => $twelveth_percentage,
        'status' => $status,
        
        'programme' => $programme,
        //'subject_streem' => $subject_streem,
        'doa' => $doa,
    );

    foreach ($usermeta as $key => $value) {
        mysqli_query($db_conn, "INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES ('$user_id','$key','$value')") or die(mysqli_error($db_conn));
    }

    $months = array('1st sem', '2nd sem', '3rd sem', '4th sem', '5th sem', '6th sem', '7th sem', '8th sem');

    // $att_data = [];
    // for ($i=1; $i <= 31; $i++) { 
    //     $att_data[$i] = [
    //         'signin_at' => '',
    //         'signout_at' => '',
    //         'date' => $i
    //     ];
    // }
    // $att_data = serialize($att_data);
    // foreach ($months as $key => $value) {
    //     mysqli_query($db_conn, "INSERT INTO `attendance` (`attendance_month`,`attendance_value`,`std_id`) VALUES ('$value','$att_data','$user_id')") or die(mysqli_error($db_conn));
    // }


    // Parent registration
    // $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$father_mobile'");
    // if(mysqli_num_rows($check_query) > 0)
    // {
    //     $parent = mysqli_fetch_object(mysqli_query($db_conn,"SELECT * FROM `accounts` as a JOIN `usermeta` as m ON a.id = m.user_id WHERE a.type = 'parent' AND a.email = '$father_mobile' AND m.meta_key = 'children';"));
    //     // $error = 'Email already exists';
    //     // echo 'Email already exists';die;
    //     $children = unserialize($parent->meta_value);
    //     $children[] = $user_id;
    //     $children = serialize($children);
    //     $query = mysqli_query($db_conn, "UPDATE `usermeta` SET `meta_value` = '$children' WHERE meta_key = 'children' ")or die(mysqli_error($db_conn));;
    // }
    // else
    // {    
    //     $md_password = md5($father_mobile);
    //     $query = mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`password`,`type`) VALUES ('$father_name','$father_mobile','$md_password','parent')") or die(mysqli_error($db_conn));
    //     if($query)
    //     {
    //         $parent_id = mysqli_insert_id($db_conn);
    //     }
    //     $chld = [$user_id];
    //     $chld = serialize($chld);
    //     mysqli_query($db_conn, "INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES ('$parent_id','children','$chld')") or die(mysqli_error($db_conn));
    // }

    $response = array(
        'success' => TRUE,
        'payment_method' => $payment_method,
        'std_id' => $user_id
    );
    echo json_encode($response);
    die;
}

?>