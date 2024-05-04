<?php include ('../includes/config.php') ?>
<?php
if (isset($_POST['submit'])) {
    $semester_id = isset($_POST['semester_id']) ? $_POST['semester_id'] : '';
    $programme_id = isset($_POST['programme_id']) ? $_POST['programme_id'] : '';
    $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : '';
    $period_id = isset($_POST['period_id']) ? $_POST['period_id'] : '';
    $day_name = isset($_POST['day_name']) ? $_POST['day_name'] : '';
    $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
    $date_add = date('Y-m-d g:i:s');
    $status = 'publish';
    $author = 1;
    $type = 'timetable';
    // $title = 
    $query = mysqli_query($db_conn, "INSERT INTO posts (`type`, `title`,`author`,`status`,`description`,`parent`) VALUES ('timetable','$type','1','publish','description',0)") or die('DB error');
    //$query = mysqli_query($db_conn, "INSERT INTO `posts`(`author`, `type`, `status`, `publish_date`) VALUES ('1', '$type','description','timetable','publish',0)") or die('DB error');
    if ($query) {
        $item_id = mysqli_insert_id($db_conn);
    }
    $metadata = array(
        'semester_id' => $semester_id,
        'programme_id' => $programme_id,
        'teacher_id' => $teacher_id,
        'period_id' => $period_id,
        'day_name' => $day_name,
        'subject_id' => $subject_id,
    );

    foreach ($metadata as $key => $value) {
        mysqli_query($db_conn, "INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$item_id','$key','$value')");
    }

    header('Location: timetable.php');
}
?>
<?php include ('header.php') ?>
<?php include ('sidebar.php') ?>
<!-- Content Header (Page header) -->


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Timetable</h1><br>

                
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">timetable</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div>

<section class="content"> 
    <div class="container-fluid">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'add') { ?>
        
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post">
                                <div class="row">
                                        <div class="col-lg">
                                            <div class="form-group">
                                                <label for="semester_id">Select Semester</label>
                                                <select require name="semester_id" id="semester_id" class="form-control">
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
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group" id="programme-container">
                                                <label for="programme_id">Select programme</label>
                                                <select require name="programme_id" id="programme_id" class="form-control">
                                                    <option value="">-Select programme-</option>
                                                </select>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg">
                                            <div class="form-group" id="programme-container">
                                                <label for="teacher_id">Select teacher</label>
                                                <select required name="teacher_id" id="teacher_id" class="form-control">
            <option value="">-Select teacher-</option>
            <?php
            // Query to fetch teachers from the accounts table where type is 'teacher'
            $teacher_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE type = 'teacher'");
            if ($teacher_query) {
                while ($teacher = mysqli_fetch_assoc($teacher_query)) {
                    // Output each teacher as an option
                    echo '<option value="' . $teacher['id'] . '">' . $teacher['name'] . '</option>';
                }
            }
            ?>
        </select>
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group" id="programme-container">
                                                <label for="period_id">Select period</label>
                                                <select require name="period_id" id="period_id" class="form-control">
                                                    <option value="">-Select period-</option>
                                                    <?php
                                                    $args = array(
                                                        'type' => 'period',
                                                        'status' => 'publish',

                                                    );
                                                    $periods = get_posts($args);
                                                    foreach ($periods as $key => $period) { ?>
                                                                        <option value="<?php echo $period->id ?>"><?php echo $period->title ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group" id="programme-container">
                                                <label for="day_name">Select day</label>
                                                <select require name="day_name" id="day_name" class="form-control">
                                                    <option value="">-Select day-</option>
                                                    <?php
                                                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

                                                    foreach ($days as $key => $day) { ?>
                                                                            <option value="<?php echo $day ?>"><?php echo ucwords($day) ?></option>
                                                        <?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group" id="programme-container">
                                                <label for="subject_id">Select subject</label>
                                                <select require name="subject_id" id="subject_id" class="form-control">
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
                                        </div>
                                        <div class="col-lg">
                                            <div class="form-group">
                                                <label for="">&nbsp;</label>
                                                <input type="submit" value="submit" name="submit" class="btn btn-success btn-sm form-control">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
        
        <?php } else { ?>
        
                <form action="" method="get">
                                <?php
                                $semester_id = isset($_GET['semester']) ? $_GET['semester'] : 43;
                                $programme_id = isset($_GET['programme']) ? $_GET['programme'] : 3;
                                $subject_id=isset($_GET['subject']) ? $_GET['subject'] : 3
                                ?>
                                    <div class="row">
                                        <div class="col-auto">
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
                                                    foreach ($classes as $key => $class) {
                                                        $selected = ($semester_id ==  $class->id)? 'selected': '';
                                                        echo '<option value="' . $class->id . '"' . $selected . '>' . $class->title . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-group" id="programme-container">
                                                <label for="programme">Select programme</label>
                                                <select require name="programme" id="programme" class="form-control">
                                                    <option value="">-Select programme-</option>
                                                    <?php
                                                    $args = array(
                                                        'type' => 'programme',
                                                        'status' => 'publish',
                                                    );
                                                    $programmes = get_posts($args);
                                                    foreach ($programmes as $programme) {
                                                        $selected = ($programme_id == $programme->id) ? 'selected' : '';
                                                        echo '<option value="' . $programme->id . '" ' . $selected . '>' . $programme->title . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-auto ">
                                            <button class="btn btn-primary float-right" style="position: relative; top:0.8cm;">Apply</button>
                                        </div>                                
                                    </div>
                                
                                </form>

                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Timing</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $args = array(
                                            'type' => 'period',
                                            'status' => 'publish',

                                        );
                                        $periods = get_posts($args);
                                        foreach ($periods as $period) {
                                            $from = get_metadata($period->id, 'from')[0]->meta_value;
                                            $to = get_metadata($period->id, 'to')[0]->meta_value;
                                            ?>

                                                            <tr>
                                                                <td><?php echo date('h:i A', strtotime($from)) ?>-<?php echo date('h:i A', strtotime($to)) ?></td>
                                                                <?php
                                                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
                                                                
                                                                foreach ($days as $day) {
                                                                    $query = mysqli_query($db_conn, "SELECT * FROM posts as p 
                                                    INNER JOIN metadata as md ON (md.item_id=p.id)
                                                    INNER JOIN metadata as mp ON (mp.item_id=p.id)
                                                    INNER JOIN metadata as mc ON (mc.item_id=p.id)
                                                    INNER JOIN metadata as ms ON (ms.item_id=p.id)
                                                    

                                                     WHERE p.type='timetable' AND p.status='publish' AND md.meta_key='day_name' AND md.meta_value='$day' AND mp.meta_key='period_id' AND mp.meta_value=$period->id 
                                                     AND mc.meta_key='semester_id' AND mc.meta_value=$semester_id AND ms.meta_key='programme_id' AND ms.meta_value=$programme_id ");
                                                                    if (mysqli_num_rows($query) > 0) {
                                                                        while ($timetable = mysqli_fetch_object($query)) {
                                                                            ?>
                                                                                                                <td>
                                                                                                                    <p>
                                                                                                                        <h10><?php
                                                                                                                        $teacher_id = get_metadata($timetable->item_id, 'teacher_id', )[0]->meta_value;
                                                                                                                        echo get_user_data($teacher_id)->name;
                                                                                                                        ?></h10><br>
                                                                                                                        <h10><?php
                                                                                                                        $subject_id = get_metadata($timetable->item_id, 'subject_id', )[0]->meta_value;
                                                                                                                        echo get_post(array('id' => $subject_id))->title;
                                                                                                                        ?></h10><br>
                                                                                                                    </p>
                                                                                                                </td>
                                                                                                <?php }
                                                                    } else { ?>
                                                                                                    <td>
                                                                                                        unscheduled
                                                                                                    </td>

                                                                                <?php }
                                                                } ?>
                                                            </tr>
                                            <?php } ?>
                            
                                 
                                    <td>1.05 PM-2.00 PM</td>
                                    <td colspan="7">
                                        <center>Lunch Break</center>
                                    </td>
                                
                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
<?php } ?>
    </div>
</section>
<script>
jQuery(document).ready(function(){

  jQuery('#semester_id').change(function(){
    //alert(jQuery(this).val());

    jQuery.ajax({
      url:'ajax.php',
      type : 'POST',
      data  : {'class_id':jQuery(this).val()},
      dataType : 'json',
      success: function(response){
        if(response.count > 0)
        {
          jQuery('#programme-container').show();        
        }
        else
        {
          jQuery('#programme-container').hide();
        }
       
        jQuery('#programme_id').html(response.options);
         
      }
    });
  });

})
</script>
<?php include ('footer.php') ?>