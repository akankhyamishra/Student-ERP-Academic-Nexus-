<?php

  $db_host='localhost';
  $db_user='root';
  $db_password='';
  $db_name='studenterp';
  $db_conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

  if (!$db_conn) {
    echo 'Connection Failed'. mysqli_connect_error();
    exit;
  }
  //session_start();
  date_default_timezone_set('Asia/Kolkata');
  include ('functions.php');

  function password_hash_bcrypt($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}
  
?>