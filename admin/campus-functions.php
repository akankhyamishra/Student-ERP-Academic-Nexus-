<?php include('../includes/config.php') ?>
<?php include('header.php') ?>

<?php include('sidebar.php') ?>

<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Campus Functions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">campus-functions</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <section class="content">
            <div class="container-fluid">
                <?php
                if (isset($_REQUEST['action'])) {
                    if ($_REQUEST['action'] === 'edit' && isset($_GET['id'])) {
                        $function_id = $_GET['id'];
                        $query = mysqli_query($db_conn, "SELECT * FROM campusfunctions WHERE id = '$function_id'");
                        $row = mysqli_fetch_assoc($query);
                        if ($row) {
                            echo '<div class="card mb-3">
                                      <div class="card-header py-2">
                                          <h3 class="card-title">Edit Informations</h3>
                                      </div>
                                      <div class="card-body">
                                          <form action="?action=update&id=' . $row['id'] . '" method="POST" enctype="multipart/form-data">
                                              <div class="form-group">
                                                  <label for="headline">Headline</label>
                                                  <input type="text" class="form-control" id="headline" name="headline" value="' . $row['headline'] . '">
                                              </div>
                                              <div class="form-group">
                                                  <label for="content">Content</label>
                                                  <textarea class="form-control" id="content" name="content" rows="5">' . $row['content'] . '</textarea>
                                              </div>
                                              <div class="form-group">
                                                  <label for="published_by">Published by</label>
                                                  <input type="text" class="form-control" id="published_by" name="published_by" value="' . $row['published_by'] . '">
                                              </div>
                                              <div class="form-group">
                                                  <label for="file">Upload File</label>
                                                  <input type="file" class="form-control-file" id="file" name="file">
                                              </div>
                                              <button type="submit" class="btn btn-primary">Update</button>
                                          </form>
                                      </div>
                                  </div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Information not found.</div>';
                        }
                    } elseif ($_REQUEST['action'] === 'update' && isset($_GET['id'])) {
                        $function_id = $_GET['id'];
                        $headline = $_POST['headline'];
                        $content = $_POST['content'];
                        $published_by = $_POST['published_by'];
                        $file_path = '';

                        if ($_FILES['file']['name'] != '') {
                            $file_name = $_FILES['file']['name'];
                            $file_tmp = $_FILES['file']['tmp_name'];
                            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                            $file_path = uniqid() . '.' . $file_extension;
                            move_uploaded_file($file_tmp, '../uploads/' . $file_path);
                        }

                        $stmt = mysqli_prepare($db_conn, "UPDATE campusfunctions SET headline=?, content=?, published_by=?, file_path=? WHERE id=?");

                        mysqli_stmt_bind_param($stmt, "ssssi", $headline, $content, $published_by, $file_path, $function_id);
    
                        mysqli_stmt_execute($stmt);
    
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            echo '<meta http-equiv="refresh" content="0; URL=\'campus-functions.php\'" />';
                            exit();
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error updating information!</div>';
                        }
                        mysqli_stmt_close($stmt);    
                    } elseif ($_REQUEST['action'] === 'delete' && isset($_GET['id'])) {
                        $function_id = $_GET['id'];
                        $query = mysqli_query($db_conn, "DELETE FROM campusfunctions WHERE id = '$function_id'");
                        if ($query) {
                            echo '<div class="alert alert-success" role="alert">Event deleted successfully!</div>';

                            exit;
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error deleting event!</div>';
                        }
                    }
                } 
                $query = mysqli_query($db_conn, "SELECT * FROM campusfunctions ORDER BY created_at DESC");
        
        if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'add-new') { 
          
            if (isset($_POST['submit'])) {

              
              $headline=isset($_POST['info_headline']) ? $_POST['info_headline'] : '';
              $published_by=isset($_POST['published_by']) ? $_POST['published_by'] : '';
                $info_content = isset($_POST['info_content']) ? $_POST['info_content'] : '';
              
                $file_path = '';

                if ($_FILES['file']['name'] != '') {
                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                    $file_path = uniqid().'.'.$file_extension;
                    move_uploaded_file($file_tmp, '../uploads/'.$file_path);
                }
              
                $stmt = mysqli_prepare($db_conn, "INSERT INTO campusfunctions (content, published_by, headline, file_path, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");

                mysqli_stmt_bind_param($stmt, "ssss", $info_content, $published_by, $headline, $file_path);

                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo '<div class="alert" role="alert" style="color: green;">Event added successfully!</div>';
                    echo "<script>window.location='{$_SERVER["REQUEST_URI"]}';</script>";

                    exit;
                } else {
                    echo '<div class="alert" role="alert" style="color: green;">Error adding event!</div>';
                }
                mysqli_stmt_close($stmt);
            

            }
            echo '<div class="card mb-3">
                    <div class="card-header py-2">
                        <h3 class="card-title">Publish new event</h3>
                    </div>
                    <div class="card-body">
                        <form action="?action=add-new" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            
                                <label for="info_headline">Headline</label>
                                <textarea class="form-control" name="info_headline" id="headline" rows="1" style=" background-color: #f2f2f2;" required></textarea>
                            </div>
                            <div class="form-group">

                                <label for="info_content">Info</label>
                                <textarea class="form-control" name="info_content" id="info_content" rows="5" style=" background-color: #f2f2f2;" required></textarea>
                            </div>
                            <div class="form-group">
                            
                                <label for="published_by">Published-By</label>
                                <textarea class="form-control" name="published_by" id="published_by" rows="1" style=" background-color: #f2f2f2;" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Upload File</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>';
        }
                else {
                    echo '<div class="card mb-3">
                    <div class="card-header py-2">
                        <h3 class="card-title">Events</h3>
                        <div class="card-tools">
                            <a href="?action=add-new" class="btn btn-success btn-sm"><i class="fa fa-plus mr-2"></i>Add New</a>
                        </div>
                    </div>
                    <div class="card-body">';
                    // Display Events Logic Here
                    $query = mysqli_query($db_conn, "SELECT * FROM campusfunctions ORDER BY created_at DESC");

                    if (mysqli_num_rows($query) > 0) {

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<div class="mb-3"> <!-- Added mb-3 class here -->
                            <div class="card">
                                <div class="card-header py-2">
                                    <div class="row">
                                        <div class="col-11">
                                            <h5 class="mb-0"><b>' . $row['headline'] . '</b></h5>
                                        </div>
                                        <div class="col-1 text-right">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' . $row['id'] . '" aria-expanded="false" aria-controls="collapse' . $row['id'] . '">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapse' . $row['id'] . '">
                                    <div class="card-body">
                                    <p><strong></strong> ' . $row['content'] . '</p>
                                        <p><strong>Published by:</strong> ' . $row['published_by'] . '</p>
                                        <p><strong>Posted at:</strong> ' . $row['created_at'] . '</p>';
                      if ($row['file_path']) {
                          echo '<p><a href="../uploads/' . $row['file_path'] . '" target="_blank">Download Attachment</a></p>';
                      }
                      echo '<div class="btn-group">
                                        <a href="?action=edit&id=' . $row['id'] . '" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="btn-group ml-2">
                                        <a href="?action=delete&id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this event?\');"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                    } else {
                        echo '<div class="alert alert-light" role="alert">No event found.</div>';
                    }
                }
                ?>
            </div>
        </section>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>

<?php include('footer.php') ?>
