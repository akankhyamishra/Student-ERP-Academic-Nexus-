<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Examination Schedule</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Student</a></li>
          <li class="breadcrumb-item active">Paper-schedule</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="semester">Select Semester:</label>
            <select class="form-control" id="semester" name="semester">
              <option value="1">Semester 1</option>
              <option value="2">Semester 2</option>
              <!-- Add options for other semesters -->
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Show Schedule</button>
        </form>
      </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $semester = $_POST['semester'];
      // Fetch subjects for the selected semester from the database
      $sql = "SELECT * FROM posts WHERE type = 'subject' AND parent = $semester";
      $result = mysqli_query($db_conn, $sql);
      if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="card">
          <div class="card-body">
            <h3>Examination Schedule for Semester <?php echo $semester; ?></h3>
            <table class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Exam Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  // You need to have a separate table to store exam times for each subject
                  // Fetch exam time from that table based on subject id
                  $subject_id = $row['id'];
                  $exam_time_sql = "SELECT exam_time FROM exam_times WHERE subject_id = $subject_id";
                  $exam_time_result = mysqli_query($db_conn, $exam_time_sql);
                  $exam_time_row = mysqli_fetch_assoc($exam_time_result);
                ?>
                  <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $exam_time_row['exam_time']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
    <?php
      } else {
        echo "No subjects found for this semester";
      }
    }
    ?>

  </div><!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php') ?>
