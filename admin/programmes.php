<?php 
include('../includes/config.php');
include('header.php');
include('sidebar.php');

$success_message = '';

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $query = mysqli_query($db_conn, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$title','description','programme','publish',0)") or die('DB error');
}

if(isset($_POST['edit_programme'])) {
    $programme_id = $_POST['programme_id'];
    $new_title = $_POST['new_title'];
    $update_query = mysqli_query($db_conn, "UPDATE `posts` SET `title` = '$new_title' WHERE `id` = '$programme_id' AND `type` = 'programme'");
    
    if($update_query) {
        $success_message = 'Programme title updated successfully.';
        echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";
        exit;
    } else {
        $success_message = 'Error occurred while updating the programme title.';
    }
}

if(isset($_POST['delete_programme'])) {
    $programme_id = $_POST['programme_id'];
    $delete_query = mysqli_query($db_conn, "DELETE FROM `posts` WHERE `id` = '$programme_id' AND `type` = 'programme'");
    
    if($delete_query) {
        $success_message = 'Programme deleted successfully.';
        echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";
        exit;
    } else {
        $success_message = 'Error occurred while deleting the programme.';
    }
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Programmes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Programmes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <!-- Small boxes (Stat box) -->
                <div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">Programmes</h3>
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
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array(
                                        'type' => 'programme',
                                        'status' => 'publish',
                                    );
                                    $programmes = get_posts($args);
                                    foreach ($programmes as $programme) {?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $programme->title ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $programme->id ?>"><i class="fas fa-edit"></i>
                                                
                                                </button>
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="programme_id" value="<?= $programme->id ?>">
                                                    <button type="submit" name="delete_programme" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                        
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?= $programme->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $programme->id ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel<?= $programme->id ?>">Edit Programme Title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="programme_id" value="<?= $programme->id ?>">
                                                            <div class="form-group">
                                                                <label for="new_title">New Title:</label>
                                                                <input type="text" class="form-control" name="new_title" required>
                                                            </div>
                                                            <button type="submit" name="edit_programme" class="btn btn-primary">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">Add New Programme</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" placeholder="Title" required class="form-control"><br>
                            </div>
                            <button name="submit" class="btn btn-success float-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
