<?php include('../includes/config.php') ?>
<?php

if(isset($_POST['class_id']) && $_POST['class_id'])
{
    $class_id = $_POST['class_id'];
    $class_meta = get_metadata($class_id,'programme');
    $count=0;
    $options = '<option value="">-Select programme-</option>';
    foreach ($class_meta as $meta){
        $programme = get_post(array('id'=>$meta->meta_value));
        $options .= '<option value="'.$programme->id.'">'.$programme->title.'</option>';
        $count++;
       
    }
    $output['count']=$count;
    $output['options']=$options;
    echo json_encode($output);
    die;
}
$type = isset($_GET['user']) ? $_GET['user'] : '';
$query = mysqli_query($db_conn, "SELECT * FROM `accounts` WHERE `type` = '$type'");
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
  // Push each row as an array to the $data array
  $data[] = [
    $row['id'], // Assuming 'id' is the primary key
    $row['name'],
    $row['email'],
    $row['userID'],
    $row['image_path'],
    // Add action buttons here
    '<a href="view-profile.php?id=' . $row['id'] . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View Profile</a>
    <form action="" method="post" style="display: inline;">
      <input type="hidden" name="delete_id" value="' . $row['id'] . '">
      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this user and their associated metadata?\');" name="delete"><i class="fa fa-trash"></i> Delete</button>
    </form>
    <form action="" method="post" style="display: inline;">
      <input type="hidden" name="user_id" value="' . $row['id'] . '">
      <input type="hidden" name="block_status" value="' . ($row['blocked'] ?? 0) . '">
      <button type="submit" class="' . (($row['blocked'] ?? 0) == 1 ? "btn btn-success btn-sm" : "btn btn-dark btn-sm") . '" name="block_user"><i class="fas fa-ban"></i>' . (($row['blocked'] ?? 0) == 1 ? "Unblock" : "Block") . '</button>
    </form>'
  ];
}

// Output the data as JSON
echo json_encode(['data' => $data]);
