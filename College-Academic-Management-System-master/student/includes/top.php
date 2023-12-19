
<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>



 <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">BCE</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
         
        
      <a class="navbar-brand py-3" href="student-profile" >
            
         <span> <?php echo($sname); ?></span>
              
        
          
          </a>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0" >
     

      
      <li class="nav-item dropdown no-arrow">
         <a class="navbar-brand py-3" href="student-profile" >
            
              <?php if(($sphoto)==""){ ?>
   <img src="studentphoto/image.png" class="img-fluid rounded-circle  align-center "
              alt="Logo"
              style="width:25px;"><?php } else {?>
   <img src="studentphoto/<?php echo htmlentities($row_student['StudentPhoto']);?>" class="img-fluid rounded-circle  align-center "
              alt="Logo"
              style="width:25px;" 
   <?php } ?>
              
        
          
          </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>

    </ul>

  </nav>