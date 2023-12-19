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
$scheme=$row_student['scheme'];

$dob= $row_student['DOB'];
$gender=$row_student['Gender'];








?>




<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BCE Student Ia Results</title>

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

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="ia-results">IA Results</a>
          </li>
          <li class="breadcrumb-item active">IA Results</li>
        </ol>

                <div class="row " >
                  <div class="col-md-3"></div>
                  
                    <div class="col-md-6 border">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                         
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form  action="../admin/ia_result" method="post" >
                       <h1 style="text-align:center;" class="border-bottom">IA Result </h1>
                              <div class="form-group"><label>USN </label><input class="form-control" type="text" name="USN" id="USN" maxlength="15" value="<?php echo $USN; ?>" autocomplete="off" readonly>    
</div>


 
<div class="form-group">
    <label >Branch </label>
<input class="form-control" type="text" name="branch" id="branch" value="<?php echo $branch; ?>" autocomplete="off" readonly />
    
    </div>


<div class="form-group">
    <label >Sem </label>
    
   <select name="sem" id="sem" class="form-control"  required="required">
<option>Select Sem</option>
<option>1 </option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option> </select> 
  </div> 






                            <div class="form-group">
                              </div><button class="btn btn-danger btn-block" type="submit" name="submit" id="submit" >View IA Results</button></form>
                           <hr />
   



</form>
                            </div>
                            </div>
                    </div>
                   
           

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
</body>
 
  </div>    <!-- /.container-fluid -->
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

</html>
<?php } ?>
