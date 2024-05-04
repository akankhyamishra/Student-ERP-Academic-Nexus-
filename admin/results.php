<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Upload Results</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Upload-Results</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="userID">Student UserID</label>
                        <input type="text" name="userID" class="form-control" id="userID" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Select Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="">- Select Semester -</option>
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
                    <button type="submit" name="fetch_subjects" class="btn btn-primary">Fetch Subjects</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['fetch_subjects'])) {
            $userID = $_POST['userID'];
            $semester_id = $_POST['semester'];

            $semester_query = mysqli_query($db_conn, "SELECT title FROM posts WHERE id = '$semester_id'");
            $semester_row = mysqli_fetch_assoc($semester_query);
            $semester_title = $semester_row['title'];

            $query = mysqli_query($db_conn, "SELECT posts.id, posts.title AS subject
                                             FROM posts
                                             WHERE posts.type = 'subject'");

            if (mysqli_num_rows($query) > 0) {
                echo "<div class='card'>
                        <div class='card-body'>
                            <h4>Enter Marks for UserID: $userID, Semester: $semester_title</h4>
                            <form method='post' action=''>
                                <input type='hidden' name='userID' value='$userID'>
                                <input type='hidden' name='semester_id' value='$semester_id'>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Quizz Marks (out of 10)</th>
                                            <th>Midterm Marks (out of 30)</th>
                                            <th>Endterm Marks (out of 50)</th>
                                            <th>Grade</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                while ($row = mysqli_fetch_assoc($query)) {
                    $subjectID = $row['id'];
                    $quizzMarks = $midtermMarks = $endtermMarks = '';

                    // Check if marks exist for this subject
                    $existingMarksQuery = mysqli_query($db_conn, "SELECT * FROM student_results WHERE userID = '$userID' AND semester = '$semester_id' AND subject_id = '$subjectID'");
                    if (mysqli_num_rows($existingMarksQuery) > 0) {
                        $marksRow = mysqli_fetch_assoc($existingMarksQuery);
                        $quizzMarks = $marksRow['quizz_mark'];
                        $midtermMarks = $marksRow['midterm_mark'];
                        $endtermMarks = $marksRow['endterm_mark'];
                    }
                    echo "<tr>
                            <td data-subject-id='{$row['id']}'>{$row['subject']}</td>
                            <td><input type='number' name='quizz[{$row['id']}]' class='form-control' min='0' max='10' step='0.01' ></td>
                            <td><input type='number' name='midterm[{$row['id']}]' class='form-control' min='0' max='30' step='0.01'></td>
                            <td><input type='number' name='endterm[{$row['id']}]' class='form-control' min='0' max='50' step='0.01' ></td>
                            <td><input type='text' name='grade[{$row['id']}]' class='form-control' readonly></td>
                            <td><button type='submit' class='btn btn-primary' name='edit_mark' value='$subjectID'>Edit</button></td>
                                                            <td><button type='submit' class='btn btn-danger' name='delete_mark' value='$subjectID'>Delete</button></td>

                          </tr>";
                }

                echo "</tbody></table>
                      <button type='submit' name='upload_results' class='btn btn-primary'>Upload Results</button>
                      </form></div></div>";
            } else {
                echo "<div class='alert alert-warning'>No subjects found for the selected semester.</div>";
            }
        }

        if (isset($_POST['upload_results'])) {
            $userID = $_POST['userID'];
            $semester_id = $_POST['semester_id'];
            $quizz = $_POST['quizz'];
            $midterm = $_POST['midterm'];
            $endterm = $_POST['endterm'];
            $grades = $_POST['grade'];

            foreach ($quizz as $subject_id => $quizz_mark) {
                $midterm_mark = $midterm[$subject_id];
                $endterm_mark = $endterm[$subject_id];

                $total_marks = $quizz_mark + $midterm_mark + $endterm_mark;
                $grade = calculate_grade($total_marks);

                $query = mysqli_query($db_conn, "INSERT INTO student_results (userID, semester, subject_id, quizz_mark, midterm_mark, endterm_mark, total_marks_obtained, grade) 
                VALUES ('$userID', '$semester_id', '$subject_id', '$quizz_mark', '$midterm_mark', '$endterm_mark',' $total_marks', '$grade')
                ON DUPLICATE KEY UPDATE quizz_mark = '$quizz_mark', midterm_mark = '$midterm_mark', endterm_mark = '$endterm_mark', total_marks_obtained='$total_marks', grade = '$grade'");
            }

            if ($query) {
                echo "<script>window.location = 'view-result.php';</script>";
                exit();           
             } else {
                echo "<div class='alert alert-danger'>Error uploading marks!</div>";
            }
            if(isset($_GET['success']) && $_GET['success'] == 'true') {
                echo "<div class='alert alert-success'>Marks uploaded successfully!</div>";
            }
        }
        if (isset($_POST['edit_mark'])) {
            $subjectID = $_POST['edit_mark'];
            $quizzMarks = $_POST['quizz'][$subjectID];
            $midtermMarks = $_POST['midterm'][$subjectID];
            $endtermMarks = $_POST['endterm'][$subjectID];

            // Update the marks in the database
            $updateQuery = mysqli_query($db_conn, "UPDATE student_results SET quizz_mark = '$quizzMarks', midterm_mark = '$midtermMarks', endterm_mark = '$endtermMarks' WHERE subject_id = '$subjectID'");

            if ($updateQuery) {
                echo "<div class='alert alert-success'>Marks updated successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating marks!</div>";
            }
        }
        if (isset($_POST['delete_mark'])) {
            $subjectID = $_POST['delete_mark'];

            // Delete marks for the subject from the database
            $deleteQuery = mysqli_query($db_conn, "DELETE FROM student_results WHERE subject_id = '$subjectID'");

            if ($deleteQuery) {
                echo "<div class='alert alert-success'>Marks deleted successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error deleting marks!</div>";
            }
        }

        function calculate_grade($total_marks)
        {
            // Define grading criteria
            $grades = array(
                'A+' => 90,
                'A' => 80,
                'B' => 70,
                'C' => 60,
                'D' => 50,
                'F' => 0
            );

            foreach ($grades as $grade => $min_marks) {
                if ($total_marks >= $min_marks) {
                    return $grade;
                }
            }
            return 'F'; 
        }
        ?>
    </div><!--/. container-fluid -->
</section>

<!-- Modal for editing marks -->


<?php include('footer.php') ?>

