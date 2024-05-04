<?php session_start()?>
<?php
include('../includes/config.php');
 if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
   
    
   $pass_md5=md5($pass);
   $query = mysqli_query($db_conn, "SELECT * FROM `accounts` WHERE `email`='$email' AND `password`='$pass_md5'");

     if(mysqli_num_rows($query)>0){
        $user=mysqli_fetch_object($query);
         $_SESSION['login']=true;
         $_SESSION['session_id']=uniqid();
        $user_type=$user->type;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['user_id'] = $user->id;
         $user_name=$user->name;
         $_SESSION['user_name'] = $user->name;
         $_SESSION['user_image'] = $user->image_path;
         header('Location: ../'.$user_type.'/dashboard.php'); // Include the user's name in the URL
         exit();
     }
    else if ($email=='admin@gmail.com' && $pass=='test123') {
      //session_start();
        $_SESSION['login']=true;
        header('Location: ../admin/dashboard.php');
    }
    else{
      header('Location: ../login.php?error=invalid_credentials');
      exit();
    }
 }
 ?>