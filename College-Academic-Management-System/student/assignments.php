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

  <title>BCE Students Assignments</title>


  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">


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
            <a href="assignments">Assignments</a>
          </li>
          <li class="breadcrumb-item active">Assignmets</li>
        </ol>


  <div class="card mb-3">
          <div class="card-header">
             <i class='fas fa-edit'> Assignments<span style="padding-left:700px;"> <?php echo "Branch:-     ".$branch; ?> </span></i>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                                        <tr>
                                           
                                            <th>#</th>
                                            <th>Description</th>
                                            <th>Sem</th>
                                            <th>Subject Code </th>
                                            <th>Last Date To Submit</th>
                                            <th>File Type</th>
                                              <th>File Size</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT assignments.id,assignments.description,assignments.subjectcode,tblclasses.sem,assignments.ldts,assignments.year,assignments.file_type,tblsubjects.SubjectCode,assignments.file_size from assignments join tblclasses on tblclasses.id=assignments.branchid join tblsubjects on tblsubjects.id=assignments.subjectcode where tblclasses.branch_name='$branch' ";

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
                                      
                                                          <td><?php echo htmlentities($result->description);?></td>
                                                      <td><?php echo htmlentities($result->sem);?></td>
                                                            <td><?php echo htmlentities($result->SubjectCode);?></td>
                                                            <td><?php echo htmlentities($result->ldts);?></td>
                                                           <td> <?php echo htmlentities($result->file_type);?></td>
                                                            <td> <?php echo htmlentities($result->file_size);?>MB</td>





                                            <td class="center"><a href="download_assignments?id=<?php echo htmlentities($result->id);?>" class="btn btn-danger">Download</a></td>
 

               <?php $cnt=$cnt+1;}} ?>                              
                                      
                                    </tbody>

              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
  </div>    

 <?php
 include('includes/footer.php');

 ?>


</div>


</div>



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

</body>
<?php } ?>