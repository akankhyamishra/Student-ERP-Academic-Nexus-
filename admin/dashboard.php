<?php include('../includes/config.php')?>
<?php include('header.php')?>

<?php include('sidebar.php')?>

<?php

$query_students = mysqli_query($db_conn, "SELECT COUNT(*) AS total_students FROM accounts WHERE type = 'student'");
$total_students = mysqli_fetch_assoc($query_students)['total_students'];

// Query to get total number of teachers
$query_teachers = mysqli_query($db_conn, "SELECT COUNT(*) AS total_teachers FROM accounts WHERE type = 'teacher'");


$total_teachers = mysqli_fetch_assoc($query_teachers)['total_teachers'];

$query = mysqli_query($db_conn, "SELECT COUNT(*) as total_subjects FROM posts WHERE type = 'subject'");

// Fetch the result
$result = mysqli_fetch_assoc($query);

// Total subjects count
$totalSubjects = $result['total_subjects'];

$sql = "SELECT * FROM notices ORDER BY id DESC";
$result = mysqli_query($db_conn, $sql);

$query_attendance = mysqli_query($db_conn, "SELECT COUNT(*) AS total_attendance FROM attendance");
$total_attendance = mysqli_fetch_assoc($query_attendance)['total_attendance'];
?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_students ?></h3>

                <p>Total Students</p>
              </div>
              <div class="icon">
              <i class="fas fa-solid fa-graduation-cap"></i>
              </div>
              <a href="user-account.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $total_teachers ?><sup style="font-size: 20px"></sup></h3>

                <p>Total Teachers</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-tie"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $totalSubjects; ?></h3>

                <p>Total Courses</p>
              </div>
              <div class="icon">
              <i class="fas fa-swatchbook"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
              <h3><?php echo $total_attendance; ?></h3>

                <p>Total Attendance</p>
              </div>
              <div class="icon">
              <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       

        <section class="content">
    <div class="container-fluid">
        <?php
         if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'delete' && isset($_GET['id'])) {
          $notice_id = $_GET['id'];
          $query = mysqli_query($db_conn, "DELETE FROM notices WHERE id = '$notice_id'");
          if ($query) {
            echo '<div class="alert" role="alert" style="color: green;">Succesfully deleted</div>';
          } else {
             
              echo '<div class="alert alert-danger" role="alert" style="color: green;">Error deleting notice!</div>';
          }
      }else{
        if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'view' && isset($_GET['id'])) {
          $notice_id = $_GET['id'];
          $query = mysqli_query($db_conn, "SELECT * FROM notices WHERE id = '$notice_id'");
          $row = mysqli_fetch_assoc($query);
          if ($row) {
              echo '<div class="card">
                          <div class="card-header py-2">
                              <h3 class="card-title">Notice</h3>
                          </div>
                          <div class="card-body">
                              <h4>' . $row['headline'] . '</h4>
                              <p>' . $row['content'] . '</p>
                              <p><strong>Published by:</strong> ' . $row['published_by'] . '</p>
                              <p><strong>Posted at:</strong> ' . $row['created_at'] . '</p>';
                              if($row['file_path']){
                                echo '<p><a href="../uploads/'.$row['file_path'].'" target="_blank">Download Attachment</a></p>';
                              }
                              echo '</div>
                      </div>';
          } else {
              echo '<div class="alert alert-danger" role="alert">Notice not found.</div>';
          }
        }elseif (isset($_REQUEST['action']) && $_REQUEST['action'] === 'edit' && isset($_GET['id'])) {
          $notice_id = $_GET['id'];
          $query = mysqli_query($db_conn, "SELECT * FROM notices WHERE id = '$notice_id'");
          $row = mysqli_fetch_assoc($query);
          if ($row) {
              echo '<div class="card">
                          <div class="card-header py-2">
                              <h3 class="card-title">Edit Notice</h3>
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
              echo '<div class="alert alert-danger" role="alert">Notice not found.</div>';
          }
      }elseif (isset($_REQUEST['action']) && $_REQUEST['action'] === 'update' && isset($_GET['id'])) {
        // Update notice logic
        $notice_id = $_GET['id'];
        $headline = $_POST['headline'];
        $content = $_POST['content'];
        $published_by = $_POST['published_by'];
        $file_path = '';

        if ($_FILES['file']['name'] != '') {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = uniqid().'.'.$file_extension;
            move_uploaded_file($file_tmp, '../uploads/'.$file_path);
        }

        $query = mysqli_query($db_conn, "UPDATE notices SET headline='$headline', content='$content', published_by='$published_by', file_path='$file_path' WHERE id='$notice_id'");
        if ($query) {
            echo '<div class="alert text-success" role="alert">Notice updated successfully!</div>';
        } else {
            echo '<div class="alert text-danger" role="alert">Error updating notice!</div>';
        }
    }
      }
        $query = mysqli_query($db_conn, "SELECT * FROM notices ORDER BY created_at DESC");
        
        if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'add-new') { 
          
            if (isset($_POST['submit'])) {

              
              $headline=isset($_POST['notice_headline']) ? $_POST['notice_headline'] : '';
              $published_by=isset($_POST['published_by']) ? $_POST['published_by'] : '';
                $notice_content = isset($_POST['notice_content']) ? $_POST['notice_content'] : '';
              
                $file_path = '';

                if ($_FILES['file']['name'] != '') {
                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                    $file_path = uniqid().'.'.$file_extension;
                    move_uploaded_file($file_tmp, '../uploads/'.$file_path);
                }
              
                $query = mysqli_query($db_conn, "INSERT INTO notices (content, published_by, headline, file_path, created_at) VALUES ('$notice_content', '$published_by', '$headline', '$file_path', CURRENT_TIMESTAMP)");
                if ($query) {
                  echo '<div class="alert" role="alert" style="color: green;">Notice added successfully!</div>';
                } else {
                    echo '<div class="alert" role="alert" style="color: green;">Error adding notice!</div>';
                }
            }
            echo '<div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">Publish new notice</h3>
                    </div>
                    <div class="card-body">
                        <form action="?action=add-new" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            
                                <label for="notice_headline">Headline</label>
                                <textarea class="form-control" name="notice_headline" id="headline" rows="1" style=" background-color: #f2f2f2;" required></textarea>
                            </div>
                            <div class="form-group">

                                <label for="notice_content">Notice Content</label>
                                <textarea class="form-control" name="notice_content" id="notice_content" rows="5" style=" background-color: #f2f2f2;" required></textarea>
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
        } else {
            echo '<div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">Notices</h3>
                        <div class="card-tools">
                            <a href="?action=add-new" class="btn btn-success btn-sm"><i class="fa fa-plus mr-2"></i>Add New</a>
                        </div>
                    </div>
                    <div class="card-body">';
            
            if (mysqli_num_rows($query) > 0) {
                // Display each notice
                while ($row = mysqli_fetch_assoc($query)) {
                  echo '<div class="alert alert-light d-flex justify-content-between" role="alert" >
                  <div class="row"><span style="width: 950px;"><i class="fa-solid fa-bell fa-shake" style="color: #deb212;"></i><b>' . $row['headline'] . '</b></span> </br> <b>Published-by</b>: ' . $row['published_by'] . ' </div>
                  
                  
                  <div class=" align-items-center" style="width: 650px;">
                  
                  <span>' . $row['created_at'] . '</span>';

                  if($row['file_path']){
                    echo '<p><a href="../uploads/'.$row['file_path'].'" target="_blank">Download Attachment</a></p>';
                  }

                  echo '<div >
                  <a href="?action=view&id=' . $row['id'] . '" class="btn btn-dark btn-xs"><i class="fa fa-eye"></i></a>
                  <a href="?action=edit&id=' . $row['id'] . '" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                      <a href="?action=delete&id=' . $row['id'] . '" class="btn btn-danger btn-xs mr-1"><i class="fa fa-trash"></i></a>

                  </div>
                  </div>
              </div>';
                }
            } else {
                echo '<div class="alert alert-light" role="alert" ">No notices found.</div>';
            }
            
            echo '</div>
                </div>';
        }
        ?>
    </div>
</section>

       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
<?php include('footer.php')?>
