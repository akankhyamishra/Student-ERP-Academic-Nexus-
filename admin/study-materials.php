<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Check if 'action' is set and equal to 'add_new'
if (isset($_GET['action']) && $_GET['action'] === 'add_new') {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $file_name = $_FILES['attachment']['name'];
        $file_tmp = $_FILES['attachment']['tmp_name'];
        $uploaded_at = date('Y-m-d H:i:s');
        $semester_title = $_POST['semester_title'];
        $subject_id = $_POST['subject_id'];
        $file_extension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);

        // Move the uploaded file to a desired location
        move_uploaded_file($file_tmp, "../uploads/$file_name");

        // Get semester ID from the semester title
        $query_semester = "SELECT id FROM posts WHERE title = '$semester_title' AND type = 'class'";
        $result_semester = mysqli_query($db_conn, $query_semester);
        $row_semester = mysqli_fetch_assoc($result_semester);
        $class_id = $row_semester['id'];

       
    
        // Insert study material into the database
        $query = "INSERT INTO study_materials (title, description, file_name, uploaded_at, class_id, subject_id, file_extension) 
                  VALUES ('$title', '$description', '$file_name', '$uploaded_at', '$class_id', '$subject_id', '$file_extension')";
        $result = mysqli_query($db_conn, $query);

        if ($result) {
            echo "<div class='alert alert-success'>Study material uploaded successfully.</div>";
            echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to upload study material.</div>";
        }
    }
  
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Study Materials</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Study-materials</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Study Material</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="attachment">Attachment:</label>
                                <input type="file" class="form-control-file" id="attachment" name="attachment" required>
                            </div>
                            <div class="form-group">
                                <label for="semester_title">Semester:</label>
                                <!-- Assuming $semesters is an array containing semester information -->
                                <select required name="semester_title" id="semester_title" class="form-control">
                                    <option value="">-Select semester-</option>
                                    <?php
                                    $query_semesters = "SELECT title FROM posts WHERE type = 'class'";
                                    $result_semesters = mysqli_query($db_conn, $query_semesters);
                                    while ($row_semester = mysqli_fetch_assoc($result_semesters)) { ?>
                                        <option value="<?php echo $row_semester['title']; ?>"><?php echo $row_semester['title']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject_id">Subject:</label>
                                <!-- Assuming $subjects is an array containing subject information -->
                                <select  name="subject_id" id="subject_id" class="form-control">
                                    <option value="">-Select subject-</option>
                                    <?php
                                    $args = array(
                                        'type' => 'subject',
                                        'status' => 'publish',
                                    );
                                    $subjects = get_posts($args);
                                    foreach ($subjects as $key => $subject) { ?>
                                        <option value="<?php echo $subject->id ?>"><?php echo $subject->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
} elseif (isset($_GET['action']) && $_GET['action'] === 'view_semester') {
    // Fetch study materials for the selected semester
    $semester_title = $_GET['semester'];
    $query = "SELECT sm.*, p.title AS subject_title FROM study_materials sm INNER JOIN posts p ON sm.subject_id = p.id INNER JOIN posts s ON sm.class_id = s.id WHERE s.title = '$semester_title' AND s.type = 'class'";
    $result = mysqli_query($db_conn, $query);
    
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Study Materials</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Study-materials</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Study Materials for <?php echo $semester_title; ?></h3>
                        <div class="card-tools">
                            <a href="?action=add_new" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>Add New</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Attachment</th>
                                        <th>Subject</th>
                                        <th>Uploaded At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><a href="../uploads/<?php echo $row['file_name']; ?>" download><?php echo $row['file_name']; ?></a></td>
                                            <td><?php echo $row['subject_title']; ?></td>
                                            <td><?php echo $row['uploaded_at']; ?></td>
                                            <td>
    <!-- Edit and Delete buttons -->
    <button type="button" class="btn btn-primary btn-xs edit-material" data-toggle="modal" data-target="#editModal"
                    data-id="<?php echo $row['id']; ?>"
                    data-title="<?php echo $row['title']; ?>"
                    data-description="<?php echo $row['description']; ?>"
                    data-semester="<?php echo $semester_title; ?>"
                    data-subject="<?php echo $row['subject_id']; ?>">
                    <i class="fas fa-edit"></i>
                </button>
            <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
</td>

                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

} elseif (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Handle delete action
    $id = $_GET['id'];
    $query = "DELETE FROM study_materials WHERE id = $id";
    $result = mysqli_query($db_conn, $query);

    if ($result) {
        echo "<div class='alert alert-success'>Study material deleted successfully.</div>";
        
       
    } else {
        echo "<div class='alert alert-danger'>Failed to delete study material.</div>";
    }
    

}else {
    ?>
   <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Study Materials</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Study-materials</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Semesters</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                $query_semesters = "SELECT title FROM posts WHERE type = 'class'";
                                $result_semesters = mysqli_query($db_conn, $query_semesters);
                                while ($row_semester = mysqli_fetch_assoc($result_semesters)) {
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card">
                                            <div class="card-header bg-dark text-white">
                                                <?php echo $row_semester['title']; ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-footer text-center">
                                                    <a href="?action=view_semester&semester=<?php echo $row_semester['title']; ?>" class="btn btn-primary btn-sm">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
<?php
}
?>
 <!-- Edit study material modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Study Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing study material details -->
                <form id="editStudyMaterialForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_material_id" id="edit_material_id">
                    <div class="form-group">
                        <label for="edit_title">Title:</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description:</label>
                        <textarea class="form-control" id="edit_description" name="edit_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_attachment">Attachment:</label>
                        <input type="file" class="form-control-file" id="edit_attachment" name="edit_attachment">
                    </div>
                    <div class="form-group">
                        <label for="edit_semester_id">Semester:</label>
                        <select required name="semester_title" id="edit_semester_title" class="form-control">
                            <option value="">-Select semester-</option>
                            <?php
                            $query_semesters = "SELECT title FROM posts WHERE type = 'class'";
                            $result_semesters = mysqli_query($db_conn, $query_semesters);
                            while ($row_semester = mysqli_fetch_assoc($result_semesters)) {
                            ?>
                                <option value="<?php echo $row_semester['title']; ?>"><?php echo $row_semester['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_subject_id">Subject:</label>
                        <select required name="subject_id" id="edit_subject_id" class="form-control">
                            <option value="">-Select subject-</option>
                            <?php
                            $args = array(
                                'type' => 'subject',
                                'status' => 'publish',
                            );
                            $subjects = get_posts($args);
                            foreach ($subjects as $key => $subject) { ?>
                                <option value="<?php echo $subject->id ?>"><?php echo $subject->title ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Function to fill edit modal fields with data
        $('.edit-material').on('click', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var semester = $(this).data('semester');
            var subject = $(this).data('subject');

            $('#edit_material_id').val(id);
            $('#edit_title').val(title);
            $('#edit_description').val(description);
            $('#edit_semester_title').val(semester);
            $('#edit_subject_id').val(subject);

            $('#editModal').modal('show');
        });

        // Function to handle saving changes
        $('#saveChangesBtn').on('click', function() {
            // Perform AJAX request to update study material
            $.ajax({
                url: 'update_study_material.php', // Change this to your PHP script URL
                type: 'POST',
                data: $('#editStudyMaterialForm').serialize(),
                success: function(response) {
                    // Handle success
                    console.log(response);
                    // Optionally close modal or refresh page
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


<?php include('footer.php'); ?>
