
<?php include('../includes/config.php') ?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<?php 
if(isset($_POST['submit'])){
    // Retrieve form data
    //$semester_id = isset($_POST['semester']) ? $_POST['semester'] : '';
    //$programme_id = isset($_POST['programme']) ? $_POST['programme'] : '';
    $subject_name = isset($_POST['subject']) ? $_POST['subject'] : '';
    $credits= isset($_POST['credits']) ? $_POST['credits'] : '';

    // Insert subject into the database
    $query = mysqli_query($db_conn, "INSERT INTO posts (author, title, type, status, description) 
                                     VALUES (1, '$subject_name', 'subject', 'publish', $credits)");

    if($query) {
        // Subject added successfully
        $_SESSION['success_msg'] = "Subject added successfully!";
    } else {
        // Error adding subject
        $_SESSION['error_msg'] = "Error adding subject!";
    }

}
if(isset($_POST['edit_subject'])) {
    $subject_id = $_POST['subject_id'];
    $new_subject_name = $_POST['new_subject_name'];
    $update_query = mysqli_query($db_conn, "UPDATE posts SET title = '$new_subject_name' WHERE id = '$subject_id' AND type = 'subject'");
    
    if($update_query) {
        $_SESSION['success_msg'] = "Subject updated successfully!";
    } else {
        $_SESSION['error_msg'] = "Error updating subject!";
    }
}
if(isset($_POST['delete_subject'])) {
    $subject_id = $_POST['subject_id'];
    
    // Delete the subject from the database
    $delete_query = mysqli_query($db_conn, "DELETE FROM posts WHERE id = '$subject_id'");
    
    if($delete_query) {
        // Subject deleted successfully
        $_SESSION['success_msg'] = "Subject deleted successfully!";
    } else {
        // Error deleting subject
        $_SESSION['error_msg'] = "Error deleting subject!";
    }
    
    echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";
    exit;
   
}

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div><!-- /.col -->
            <?php
           
           if(isset($_SESSION['success_msg']))
           {?>
             <div class="col-12">
               <small class="text-success" style="font-size:16px"><?=$_SESSION['success_msg']?></small>
             </div>
           <?php 
             unset($_SESSION['success_msg']);
           }
         ?>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div>

<section class="content">
    <div class="container-fluid">
        <?php
        if (isset($_REQUEST['action'])) { ?>
            

        <?php } else { ?>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title">
                                Add new subject
                            </h3>

                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="semester">Select Semester</label>
                                    <select require name="semester" id="semester" class="form-control">
                                        <option value="">-Select semester-</option>
                                        <?php
                                        $args = array(
                                            'type' => 'class',
                                            'status' => 'publish',

                                        );
                                        $classes = get_posts($args);
                                        foreach ($classes as $key => $class) { ?>
                                            <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                  
                                <div class="form-group">
                                    <label for="subject">Subject Name</label>
                                    <input require type="text" name="subject" id="subject" placeholder="Subject Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="credits">Credits</label>
                                    <input require type="text" name="credits" id="credits" placeholder="Enter Credit Score" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title">Subjects</h3>
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive bg-white">
                                <table id="subjects-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Credits</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        $count = 1;
                                        $args=array(
                                            'type'=> 'subject',
                                            'status'=>'publish',
                
                                        );
                                        $subjects=get_posts($args);
                                        foreach ($subjects as $subject) {?>
                                            <tr>
                                                <td><?= $count++ ?></td>
                                                <td><?= $subject->title ?></td>
                                                <td><?= $subject->publish_date ?></td>
                                                <td><?= $subject->description ?></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $subject->id ?>">
                                                <i class="fas fa-edit"></i>
                                                </button>
                                                     <!-- Form to delete subject -->
                                                     <form action="" method="post" style="display: inline;">
                                                    <input type="hidden" name="subject_id" value="<?= $subject->id ?>">
                                                    <button type="submit" name="delete_subject" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
               
            </td>
                                            </tr>
                                            <div class="modal fade" id="editModal<?= $subject->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $subject->id ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel<?= $subject->id ?>">Edit Subject Name</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="subject_id" value="<?= $subject->id ?>">
                                                            <div class="form-group">
                                                                <label for="new_subject_name">New Subject Name:</label>
                                                                <input type="text" class="form-control" name="new_subject_name" required>
                                                            </div>
                                                            <button type="submit" name="edit_subject" class="btn btn-primary">Save Changes</button>
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
            </div>


        <?php } ?>
    </div>
</section>
<!-- /.content -->
<?php include('footer.php') ?>
<script>
    $(document).ready(function() {
        $('#subjects-table').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "pageLength": 10 // Initial page length (number of entries to display)
        });
    });
</script>