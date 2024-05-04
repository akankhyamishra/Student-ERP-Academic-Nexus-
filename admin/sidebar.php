<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../contact.php" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
      <a href="../logout.php" class="nav-link" title="Logout">
        Logout <i class="fa fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../contact.php" class="brand-link">
    <img src="..\assets\img\180942088_padded_logo.png" alt="AdminLTE" class="brand-image img-circle elevation-10" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image" >
        <img src="<?php echo isset($_SESSION['user_image']) ? htmlspecialchars($_SESSION['user_image']) : 'user.jpg'; ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block"><?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Admin'; ?></a>
    </div>
</div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
         
             
              <li class="nav-item">
                <a href="./user-account.php?user=student" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
              
              
            </ul>
          </li>
            <!-- Manage Classes -->
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>
                Manage Classes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              
              <li class="nav-item">
                <a href="./classes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semesters</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="./subjects.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./programmes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Programmes</p>
                </a>
              </li>
              
            </ul>
          </li>
           <!-- Class Routine -->
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Manage Class Routines
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="./periods.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Periods</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./timetable.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Time Table</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Examination -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Manage Results
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="./results.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Results</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./view-result.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Results</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Attendance -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Manage Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>       
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./attendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance</p>
                </a>
              </li>
              
            </ul>       
          </li>

          <!-- Manage Accounts -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Manage Accountings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="./student-fee.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Fee Details</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Study Materials -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>
                Study Materials
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>  
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./study-materials.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Study Materials</p>
                </a>
              </li>
            </ul>           
          </li>

          <!-- Event -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Manage Events
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>     
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./campus-functions.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Campus Functions</p>
                </a>
              </li>
             
            </ul>        
          </li>
          <!-- Communication -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Communications
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>    
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./feedback-issues.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Feedbacks/Queries</p>
                </a>
              </li>
            </ul>          
          </li>

          <!-- Acadmy Settings -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle-info"></i>
              <p>
                Academy Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>    
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./basic-informations.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Basic Informations</p>
                </a>
              </li>
            </ul>          
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">