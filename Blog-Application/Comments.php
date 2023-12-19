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
      <title>Comments</title>
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
         <div id="content" style="background-color:black;">
            <?php include('include/top_nav.php');?>
            <nav class="text-white" style="--bs-breadcrumb-divider: '>'; background-color: black;" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile Edit</li>
                    </ol>
                </nav>
            <div class="container-fluid" style="background-color: black;">
               <div class="d-sm-flex justify-content-between align-items-center mt-n2 mb-1 text-white">
                  <h1><i class="fas fa-comments" style="color:white;"></i> Comments Page </h1>
               </div>
           <div class="float-center justify-content-center">
               <?php include('include/buttons.php');?>
               </div>
               <div class="container mt-3">
                  <div class="col-lg-12">
                     <div class="row justify-content-center">
                     <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
                        <div class="card mb-3 bg-light" >
                           <div class="card-header text-white" style="background-color:black">
                           
                              <h2><i class="far fa-thumbs-down"></i> Un-Approved Comments</h2>
                           </div>
                           <div class="card-body bg-light">
                              <div class="table-responsive table-light">
                                 <table class="table  table-borderless py-2 table-light text-center" style="color: black;" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                <th>No. </th>
                <th>Date&Time</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Aprove</th>
                <th>Action</th>
                <th>Details</th>
              </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                <th>No. </th>
                <th>Date&Time</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Aprove</th>
                <th>Action</th>
                <th>Details</th>
              </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
          global $ConnectingDB;
          $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
          $Execute =$ConnectingDB->query($sql);
          $SrNo = 0;
          while ($DataRows=$Execute->fetch()) {
            $CommentId = $DataRows["id"];
            $DateTimeOfComment = $DataRows["datetime"];
            $CommenterName = $DataRows["name"];
            $CommentContent= $DataRows["comment"];
            $CommentPostId = $DataRows["post_id"];
            $SrNo++;
          ?>
           <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($DateTimeOfComment); ?></td>
              <td><?php echo htmlentities($CommenterName); ?></td>
              <td><?php echo htmlentities($CommentContent); ?></td>
              <td> <a href="ApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-success">Approve</a>  </td>
              <td> <a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-danger">Delete</a>  </td>
              <td style="min-width:140px;"> <a class="btn btn-primary"href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a> </td>
            </tr>
          </tbody>
          <?php } ?>
                                  </table>
                              </div>
                           </div>
                        </div>
                        <div class="card mt-3 bg-light" >
                           <div class="card-header text-white" style="background-color:black">
                          
                              <h2>  <i class="far fa-thumbs-up"></i> Approved Comments</h2>
                           </div>
                           <div class="card-body bg-light">
                              <div class="table-responsive table-light">
                                 <table class="table  table-borderless py-2 table-light text-center" style="color: black;" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                <th>No. </th>
                <th>Date&Time</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Approved by</th>
                <th>Revert</th>
                <th>Action</th>
                <th>Details</th>
              </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                <th>No. </th>
                <th>Date&Time</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Approved by</th>
                <th>Revert</th>
                <th>Action</th>
                <th>Details</th>
              </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
          global $ConnectingDB;
          $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
          $Execute =$ConnectingDB->query($sql);
          $SrNo = 0;
          while ($DataRows=$Execute->fetch()) {
            $CommentId         = $DataRows["id"];
            $DateTimeOfComment = $DataRows["datetime"];
            $CommenterName     = $DataRows["name"];
            $ApprovedBy        = $DataRows["approvedby"];
            $CommentContent    = $DataRows["comment"];
            $CommentPostId     = $DataRows["post_id"];
            $SrNo++;
          ?>
                                        <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($DateTimeOfComment); ?></td>
              <td><?php echo htmlentities($CommenterName); ?></td>
              <td><?php echo htmlentities($CommentContent); ?></td>
              <td><?php echo htmlentities($ApprovedBy); ?></td>
              <td style="min-width:140px;"> <a href="DisApproveComments.php?id=<?php echo $CommentId;?>" class="btn btn-warning">Dis-Approve</a>  </td>
              <td> <a href="DeleteComments.php?id=<?php echo $CommentId;?>" class="btn btn-danger">Delete</a>  </td>
              <td style="min-width:140px;"> <a class="btn btn-primary"href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a> </td>
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