<?php 
error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/config.php"); 
 include("include/Sessions.php"); 

   $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
  
   Confirm_Login(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Dashboard </title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
 
      <link rel="stylesheet" href="datatables/d/datatables.css">
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
         <div id="content">
         
            <?php include('include/top_nav.php');?>
            <div class="container-fluid" style="background-color: black;">
               <div class="d-sm-flex justify-content-between align-items-center mt-n4 mb-1 text-white mb-2">
                  <h1><i class="fas fa-cog" style="color:white;"></i> Dashboard</h1>
               </div>
               <div class="row">
                  <div class="col-md-6 col-xl-3 mb-4">
                     <div class="card shadow border-left-primary py-2">
                        <div class="card-body">
                           <div class="row align-items-center no-gutters">
                              <div class="col mr-2">
                                 <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Total Posts</span></div>
                                 <div class="text-dark font-weight-bold h5 mb-0"><span><?php TotalPosts(); ?></span></div>
                              </div>
                              <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-xl-3 mb-4">
                     <div class="card shadow border-left-success py-2">
                        <div class="card-body">
                           <div class="row align-items-center no-gutters">
                              <div class="col mr-2">
                                 <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Categories</span></div>
                                 <div class="text-dark font-weight-bold h5 mb-0"><span><?php TotalCategories();?></span></div>
                              </div>
                              <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-xl-3 mb-4">
                     <div class="card shadow border-left-info py-2">
                        <div class="card-body">
                           <div class="row align-items-center no-gutters">
                              <div class="col mr-2">
                                 <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Total Comments</span></div>
                                 <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                       <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span><?php TotalComments();?></span></div>
                                    </div>
                                    <div class="col">
                                       <div class="progress progress-sm">
                                          <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="sr-only">50%</span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-xl-3 mb-4">
                     <div class="card shadow border-left-warning py-2">
                        <div class="card-body">
                           <div class="row align-items-center no-gutters">
                              <div class="col mr-2">
                                 <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Total Visitors</span></div>
                                 <div class="text-dark font-weight-bold h5 mb-0"><span>  <?php 
                                 
                                 
$query1="Select * from count_views";
$result=mysqli_query($con,$query1);

if(!$result)
{
  die("Retrieving Error");
}
$total_visitor_count=mysqli_num_rows($result);
                                 
                                 echo $total_visitor_count?></span></div>
                              </div>
                              <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                <?php include('include/buttons.php');?>
               <div class="container">
                  <div class="col-md-12">
                     <div class="row">
                        <?php
                           echo ErrorMessage();
                           echo SuccessMessage();
                           ?>
                        
                        <div class="card mb-3 bg-light mt-5" >
                           <div class="card-header text-white" style="background-color:black">
                           <i class="far fa-image fa-2x text-primary mr-3"> Top Posts</i> 
                           </div>
                           <div class="card-body bg-light">
                              <div class="table-responsive table-light">
                                 <table class="table  table-borderless py-2 table-light text-center" style="color: black;" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th>No.</th>
                                          <th>Title</th>
                                          <th>Date&Time</th>
                                          <th>Author</th>
                                          <th rowspan="2">Comments:</th>
                                          <th>Details</th>
                                       </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                          <th>No.</th>
                                          <th>Title</th>
                                          <th>Date&Time</th>
                                          <th>Author</th>
                                          <th >Comments</th>
                                          <th>Details</th>
                                       </tr>
                                    </tfoot>
                                    <tbody>
                                       <?php
                                          $SrNo = 0;
                                          global $ConnectingDB;
                                          $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
                                          $stmt=$ConnectingDB->query($sql);
                                          while ($DataRows=$stmt->fetch()) {
                                            $PostId = $DataRows["id"];
                                            $DateTime = $DataRows["datetime"];
                                            $Author  = $DataRows["author"];
                                            $Title = $DataRows["title"];
                                            $SrNo++;
                                           ?>
                                       <tr>
                                          <td><?php echo $SrNo; ?></td>
                                          <td><?php echo $Title; ?></td>
                                          <td><?php echo $DateTime; ?></td>
                                          <td><?php echo $Author; ?></td>
                                          <td>
                                             <?php $Total = ApproveCommentsAccordingtoPost($PostId);
                                                if ($Total>0) {
                                                  ?>
                                             <span class="badge badge-success">
                                             <?php
                                                echo $Total; ?>
                                             </span>
                                             <?php  }   ?>
                                             <?php $Total = DisApproveCommentsAccordingtoPost($PostId);
                                                if ($Total>0) {  ?>
                                             <span class="badge badge-danger">
                                             <?php
                                                echo $Total; ?>
                                             </span>
                                             <?php  }  ?>
                                          </td>
                                          <td> <a target="_blank" href="FullPost.php?id=<?php echo $PostId; ?>">
                                             <span class="btn btn-outline">Preview</span>
                                             </a>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <?php } ?>
                                 </table>
                              </div>
                           </div>
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