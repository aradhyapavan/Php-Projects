<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])=="")
    {   
    header("Location:../index.php"); 
    }
    else{

$student_session = $_SESSION['login'];

$get_student = "select * from student where USN='$student_session'";

$run_student= mysqli_query($con,$get_student);

$row_student = mysqli_fetch_array($run_student);
$sphoto = $row_student['StudentPhoto'];



$sname = $row_student['sname'];


$USN = $row_student['USN'];

$email=$row_student['s_email'];
 
$mobile_no= $row_student['mobile_no'];
$branch=$row_student['branch'];

  ?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BCE Student Links</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">

</head>

<body id="page-top">

 
<?php
 include('includes/top.php');

 ?>
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
 include('includes/sidebar.php');

 ?>

    <div id="content-wrapper">

  <div class="container-fluid">

  <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="important-links">Links</a>
          </li>
          <li class="breadcrumb-item active">Links</li>
        </ol>


  <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-external-link-alt">Links</i></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                                        <tr>
                                           
                                            <th>#</th>
                                            <th>Branch</th>
                                            <th>Site Name</th>
                                              <th>Description</th>
                                            <th>Links </th>
                                            
                                            <th>Visit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT links.id,links.branch_name,links.site_name,links.description,links.links from links where branch_name='$branch' ";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
  <tr class="odd gradeX">
 <td><?php echo htmlentities($cnt);?></td>                                  
                                      
                                                          <td><?php echo htmlentities($result->branch_name);?></td>
                                                      <td><?php echo htmlentities($result->site_name);?></td>
                                                      <td><?php echo htmlentities($result->description);?></td>
                                                            <td><?php echo htmlentities($result->links);?></td>
                                                       





                                            <td class="center"><a href="<?php echo htmlentities($result->links);?>" target="_blank" ><i class="fas fa-external-link-alt">Visit</i>
</a></td>
 

               <?php $cnt=$cnt+1;}} ?>                              
                                      
                                    </tbody>

              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">
                               

</div>
        </div>
  </div>    



 <?php
 include('includes/footer.php');

 ?>

</div>


</div>


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>



<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="vendor/jquery-easing/jquery.easing.min.js"></script>


<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>


<script src="js/sb-admin.min.js"></script>


<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

   <script src="assets/js/custom.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>

</body>
<?php } ?>