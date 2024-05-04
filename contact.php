<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Contact Card</title>
  <!-- Bootstrap CSS -->
  <link rel="icon" type="image/png" href="assets\img\180942088_padded_logo.png" sizes="96x96" />

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for styling */
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color: #3B71CA;
      color: #fff;
      border-radius: 10px 10px 0 0;
    }
    .contact-info p {
      font-size: 16px;
      margin-bottom: 5px;
    }
    .social-icons a {
      color: #007bff;
      font-size: 24px;
      margin: 0 5px;
      transition: color 0.3s ease-in-out;
    }
    .social-icons a:hover {
      color: #0056b3; /* Change color on hover */
    }
  </style>
</head>
<body>

  <div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header text-center">
            <h4>Contact Admin</h4>
            <!-- Admin's Icon -->
            <i class="fas fa-user-circle fa-5x"></i>
          </div>
          <div class="card-body text-center">
            <div class="contact-info">
              <!-- Email -->
              <p><i class="fas fa-envelope"></i> admin@example.com</p>
              <hr>
              <!-- Phone Numbers -->
              <p><i class="fas fa-phone"></i> +1234567890, +9876543210</p>
              <hr>
              <!-- Address -->
              <p><i class="fas fa-map-marker-alt"></i> 123 Street, City, Country</p>
              <hr>
            </div>
            <div class="social-icons">
              <!-- Social Icons -->
              <a href="#" class="btn btn-outline-info"><i class="fab fa-twitter"></i></a>
              <a href="#" class="btn btn-outline-info"><i class="fab fa-facebook"></i></a>
              <a href="#" class="btn btn-outline-info"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">Academic Nexus</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript (assuming you are using Bootstrap) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
  (function(){
    var path = window.location.href;
    // console.log(path);
    $(".nav-link").each(function () {

      var href = $(this).attr('href');
      // console.log(href);
      if (path === decodeURIComponent(href)) 
      {
        $(this).addClass('active');
        var parent = $(this).closest('.has-treeview');
        parent.addClass('menu-open');
        $(parent).find('.nav-link').first().addClass('active');
        // console.log(parent);
      };
    });
  }());
</script>

<script>
jQuery(document).ready(function(){

  jQuery('#semester').change(function(){
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
       
        jQuery('#programme').html(response.options);
         
      }
    });
  });

})
</script>


  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
