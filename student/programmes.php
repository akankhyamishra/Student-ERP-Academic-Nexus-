<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<!-- Content Header (Page header) -->

<?php
if(isset($_POST['submit'])){
$title=$_POST['title'];
$query = mysqli_query($db_conn, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$title','description','programme','publish',0)") or die('DB error');
}
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Programmes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
                    <li class="breadcrumb-item active">Programmes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">


                <!-- Small boxes (Stat box) -->
                <div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">Programmes</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array(
                                        'type' => 'programme',
                                        'status' => 'publish',

                                    );
                                    $programmes=get_posts($args);
                                    foreach ($programmes as $programme) {?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $programme->title ?></td>
                                            <td></td>
                                            
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

<?php include('footer.php') ?>