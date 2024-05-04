<?php 
include('../includes/config.php');
include('header.php');
include('sidebar.php');

$success_message = '';

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $programmes = $_POST['programme'];

    $query = mysqli_query($db_conn, "INSERT INTO `posts` (`author`, `title`, `description`, `type`, `status`, `parent`) VALUES ('1', '$title', 'description', 'class', 'publish', 0)") or die('DB error');
    
    if($query) {
        $post_id = mysqli_insert_id($db_conn);
        
        foreach ($programmes as $key => $value) {
            mysqli_query($db_conn, "INSERT INTO `metadata` (`item_id`, `meta_key`, `meta_value`) VALUES ('$post_id', 'programme', '$value')") or die(mysqli_error($db_conn));
        }
    }
}

if(isset($_POST['delete_class'])) {
    $class_id = $_POST['class_id'];
    // Delete associated programmes from metadata table
    mysqli_query($db_conn, "DELETE FROM `metadata` WHERE `item_id` = '$class_id'");
    // Delete the class itself
    $delete_query = mysqli_query($db_conn, "DELETE FROM `posts` WHERE `id` = '$class_id' AND `type` = 'class'");
    
    if($delete_query) {
        $success_message = 'Class (semester) deleted successfully.';
    } else {
        $success_message = 'Error occurred while deleting the class (semester).';
    }
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Semesters</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Semesters</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header py-2">
                <h3 class="card-title">Semesters</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <?php if($success_message): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <div class="table-responsive bg-white">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Semesters</th>
                                <th>Programmes</th>
                                <th>Credits</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $args=array(
                                'type'=> 'class',
                                'status'=>'publish',
                            );
                            $classes=get_posts($args);
                            foreach($classes as $class) { ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $class->title ?></td>
                                    <td>
                                        <?php 
                                        $class_meta=get_metadata($class->id, 'programme');
                                        foreach($class_meta as $meta){
                                            $programme=get_post(array('id'=>$meta->meta_value));
                                            echo $programme->title.'<br>'; 
                                        }
                                        ?>
                                    </td>
                                    <td><?= $class->description?></td>
                                    <td><?= $class->publish_date?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="class_id" value="<?= $class->id ?>">
                                            <button type="submit" name="delete_class" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php') ?>
