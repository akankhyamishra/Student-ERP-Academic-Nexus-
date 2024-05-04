<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">View Results</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">View-Results</li>
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
                        <label for="studentID">Student ID</label>
                        <input type="text" name="studentID" class="form-control" id="studentID" required>
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
                    <button type="submit" name="view_results" class="btn btn-primary">View Results</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['view_results'])) {
            $studentID = $_POST['studentID'];
            $semester_id = $_POST['semester'];

            // Query to retrieve semester title
            $semester_query = mysqli_query($db_conn, "SELECT title FROM posts WHERE id = '$semester_id'");
            $semester_row = mysqli_fetch_assoc($semester_query);
            $semester_title = $semester_row['title'];
            $subjects_query = mysqli_query($db_conn, "SELECT * FROM posts WHERE type = 'subject'");
            $subjects = array();
            while ($row = mysqli_fetch_assoc($subjects_query)) {
                $subjects[$row['id']] = $row;
            }


            // Query to retrieve student results for the specified semester
            $results_query = mysqli_query($db_conn, "SELECT * FROM student_results WHERE userID = '$studentID' AND semester = '$semester_id'");

            if (mysqli_num_rows($results_query) > 0) {
                $total_grade_points = 0;
                $total_credits = 0;
                echo "<div class='card'>
                        <div class='card-body'>
                            <h4>Results for Student ID: $studentID, Semester: $semester_title</h4>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Quizz Marks</th>
                                        <th>Midterm Marks</th>
                                        <th>Endterm Marks</th>
                                        <th>Total Marks</th>
                                        <th>Grade Point</th>
                                        <th>Grade</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>";

                while ($row = mysqli_fetch_assoc($results_query)) {
                    $subject = $subjects[$row['subject_id']];
                    $quizz_marks = $row['quizz_mark'];
                    $midterm_marks = $row['midterm_mark'];
                    $endterm_marks = $row['endterm_mark'];
                    // Calculate total marks obtained
                    $total_marks_obtained = $quizz_marks + $midterm_marks + $endterm_marks;
                    // Calculate percentage
                    $percentage = ($total_marks_obtained / 90) * 100;
                    // Calculate grade point
                    $grade_point = number_format(($percentage / 95) * 10, 1);

                    echo "<tr>
                    <td>{$subject['title']}</td>
                            <td>{$quizz_marks}</td>
                            <td>{$midterm_marks}</td>
                            <td>{$endterm_marks}</td>
                            <td>{$total_marks_obtained}</td>
                            <td>{$row['grade']}</td>
                            <td>{$grade_point}</td>
                            
                          </tr>";
                          $total_grade_points += $grade_point * $subject['description']; // Multiply by credits
                    $total_credits += $subject['description'];
                }

                echo "</tbody></table></div></div>";

                $cgpa = number_format($total_grade_points / $total_credits, 2);



                function getGradePoint($grade)
                {
                    switch ($grade) {
                        case 'A+':
                            return 4.0;
                        case 'A':
                            return 4.0;
                        case 'A-':
                            return 3.7;
                        case 'B+':
                            return 3.3;
                        case 'B':
                            return 3.0;
                        case 'B-':
                            return 2.7;
                        case 'C+':
                            return 2.3;
                        case 'C':
                            return 2.0;
                        case 'C-':
                            return 1.7;
                        case 'D':
                            return 1.0;
                        default:
                            return 0.0;
                    }
                }

                echo "<div class='card'>
                <div class='card-body'>
                    
                    <h4><center>CGPA: $cgpa</center></h4>
                </div>
              </div>";
            } else {
                // No results found for the specified student ID and semester
                echo "<div class='alert alert-warning'>No such results found for Student ID: $studentID, Semester: $semester_title</div>";
            }
        }
        ?>

    </div><!--/. container-fluid -->
</section>


<?php include('footer.php') ?>