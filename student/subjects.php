
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
    
    // Redirect back to the same page
    // Redirect back to the same page
    echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";
    exit;
   
}

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
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
       
            <!-- Small boxes (Stat box) -->
            <div class="row">
                
                <div class="col-lg-12">
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
                                            <th>Credits</th>
                                            
                                            
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
                                                <td><?= $subject->description ?></td>
                                                
                                                
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


       
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
