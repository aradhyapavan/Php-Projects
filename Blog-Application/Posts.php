<?php

error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 

   $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
  
   Confirm_Login(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Posts</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="datatables/d/datatables.css">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

      <link href="https://unpkg.com/@primer/css/dist/primer.css" rel="stylesheet" />
   </head>
   <style>
      .h-divider {
      margin-top: 5px;
      margin-bottom: 5px;
      height: 1px;
      width: auto;
      border-top: 2px dashed white;
      }
      .sidebar hr.sidebar-divider {
      margin: 0 1rem 1rem;
      }
      .sidebar-light hr.sidebar-divider {
      border-top: 1px solid #eaecf4;
      }
      .sidebar-dark hr.sidebar-divider {
      border-top: 1px solid rgba(255, 255, 255, 0.15);
      }
      .sidebar-dark .sidebar-heading {
      color: rgba(255, 255, 255, 0.4);
      }
   </style>
   </style>
   <body id="page-top">
      <div id="wrapper">
      <?php include('include/nav.php');?>
      <div class="d-flex flex-column" id="content-wrapper">
         <div id="content" style="background-color:black; ">
            <?php include('include/top_nav.php');?>
            <nav class="text-white" style="--bs-breadcrumb-divider: '>'; background-color: black;" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Posts </li>
                    </ol>
                </nav>
            <div class="container-fluid" style="background-color: black;">
               <div class="d-sm-flex justify-content-between align-items-center mt-n2 mb-1 text-white mb-3">
                  <h1><i class="far fa-image" style="color:white;"></i> Posts</h1>
               </div>
         
               <?php include('include/buttons.php');?>
             
               <div class="container">
                  <div class="col-md-12">
                     <div class="row">
                        <?php
                           echo ErrorMessage();
                           echo SuccessMessage();
                           ?>
                    
                     
                        <div class="card mb-3 bg-light" >
                                <div class="card-header text-white" style="background-color:black">
                               <span> <h3><i class="fas fa-images "></i> All  Posts</h3 ></span></div>
                                <div class="card-body bg-light">
                               
                                    <div class="table-responsive table-light">
                                        <table class="table  table-borderless py-2 table-light text-center" style="color: black;" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date&Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Preview</th>
            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date&Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Preview</th>
            </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php
                    global $ConnectingDB;
                    $sql  = "SELECT * FROM posts ORDER BY id desc";
                    $stmt = $ConnectingDB->query($sql);
                    $Sr = 0;
                    while ($DataRows = $stmt->fetch()) {
                      $Id        = $DataRows["id"];
                      $DateTime  = $DataRows["datetime"];
                      $PostTitle = $DataRows["title"];
                      $Category  = $DataRows["category"];
                      $Admin     = $DataRows["author"];
                      $Image     = $DataRows["image"];
                      $PostText  = $DataRows["post"];
                      $Sr++;
                    ?>
            
            <tr>
          <td>
              <?php echo $Sr; ?>
          </td>
          <td>
              <?php
                  if(strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
                   echo $PostTitle;
               ?>
           </td>
           <td>
              <?php
                  if(strlen($Category)>8){$Category= substr($Category,0,8).'..';}
                   echo $Category ;
               ?>
           </td>
           <td>
              <?php
                  if(strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
                     echo $DateTime ;
              ?>
          </td>
          <td>
              <?php
                  if(strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
                     echo $Admin ;
               ?>
          </td>
              <td><img src="Uploads/<?php echo $Image ; ?>" width="80px;" height="80px"></td>
              <td>
                  <?php $Total = ApproveCommentsAccordingtoPost($Id);
                  if ($Total>0) {
                    ?>
                    <span class="badge badge-success">
                      <?php
                    echo $Total; ?>
                    </span>
                      <?php  }  ?>
                <?php $Total = DisApproveCommentsAccordingtoPost($Id);
                if ($Total>0) {
                                ?>
                  <span class="badge badge-danger">
                    <?php
                  echo $Total;  ?>
                  </span>
                    <?php  }    ?>
              </td>
              <td>
                <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-outline my-1"><i class="fa fa-edit"></i> Edit</span></a>
                <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</span></a>
              </td>
              <td>
                <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary"><i class="fa fa-eye text-white"></i> Live Preview</span></a>
              </td>
                </tr>
                </tbody>
        <?php } ?> 
 </table>
                                    </div> </div>
                                
                            </div>
                     </div>
                  </div>
               </div>
            </div>
            <footer class="sticky-footer mt-2" style="background-color: black;">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright text-white"><span>Designed & Developed By Ardent Connect Team</span></div>
                </div>
            </footer>
         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
      <script src="assets/js/script.min.js"></script>
      
    <script src="datatables/datatables-demo.js"></script>
    <script src="datatables/dataTables.bootstrap4.min.js"></script>


    <script src=" https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="datatables/d/datatables.min.js">
   
   </body>
</html>