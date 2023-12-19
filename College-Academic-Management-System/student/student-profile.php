<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])=="")
    {   
    header("Location:../index"); 
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



if(isset($_POST['update'])){

$photo=$_FILES["photo"]["name"];

move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);



$u_sname=$_POST['sname'];
$u_USN=$_POST['USN']; 

$u_email=$_POST['email'];

$u_mobile_no=$_POST['mobileno']; 
$u_branch=$_POST['branch'];
$u_scheme=$_POST['scheme'];

$u_dob=$_POST['dob']; 
$u_gender=$_POST['gender'];





}






?>




<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BCE Student Profile</title>


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

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Profile</a>
          </li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>

        <!-- Icon Cards-->
        <form  method="post" action="student-profile-edit" enctype="multipart/form-data">

<h1 style="text-align:center;">Profile </h1>
       <div class="form-row profile-row">
           <div class="col-md-4  relative" >
               <div >

                   <div style="text-align:center;">
<?php if(($sphoto)==""){ ?>
<img src="studentphoto/image.png"  width="150" height="200" class=" img-circle img-responsive  center-block" style="padding-bottom:10px; text-align:center"><?php } else {?>
<img src="studentphoto/<?php echo htmlentities($row_student['StudentPhoto']);?>" width="250" height="350" class="img-fluid rounded-circle " style="padding-bottom:10px;  text-align:center">
<?php } ?></div>
               </div></div>
               






                 <div class="col-md-8">
          
               <hr>
               <div class="form-row">
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label>Student Name</label><input class="form-control" type="text" name="sname" id="sname"  value="<?php echo $sname; ?>" autocomplete="off" readonly></div>
                   </div>
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label>USN </label><input class="form-control" type="text" name="USN" id="USN" maxlength="15"  value="<?php echo $USN; ?>" autocomplete="off" readonly> </div>
                   </div>
               </div>



<div class="form-row">
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label> Email</label>
         <input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>"  autocomplete="off" required  readonly/></div>
                   </div>
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label>Mobile Number :</label>
<input class="form-control" type="text" name="mobile_no" id="mobile_no" maxlength="10" value="<?php echo $mobile_no; ?>" autocomplete="off" required readonly /></div>
                   </div>
               </div>


<div class="form-row">
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label >Branch </label>
<input class="form-control" type="text" name="branch" id="branch"  value="<?php echo $branch; ?>" autocomplete="off" readonly /></div>
                   </div>
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label >Scheme </label>


<input class="form-control" type="text" name="scheme" id="scheme" value="<?php echo $scheme; ?>" autocomplete="off" readonly /></div>
                   </div>
               </div>
               

<div class="form-row">
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label >DOB</label>
                                                   
                                                       <input type="date" name="dob" id="dob" class="form-control"  value="<?php echo $dob; ?>" readonly></div>
                   </div>
                   <div class="col-sm-12 col-md-6">
                       <div class="form-group"><label for="default" class="col-sm-2 control-label">Gender</label>
<div class="col-sm-10">
<?php  
if($gender=="Male")
{
?>
<input type="radio" name="gender" id="gender" value="Male" required="required" checked>Male <input type="radio" name="gender" value="Female" required="required" readonly>Female 
<?php }?>
<?php  
if($gender=="Female")
{
?>
<input type="radio" name="gender" id="gender" value="Male" required="required" >Male <input type="radio" name="gender" value="Female" required="required" checked readonly>Female
<?php }?>

</div>

</div>
                   </div>
               </div>


                   

               <hr>



                       <div class="form-group">
                           
                       </div><button class="btn btn-danger btn-block"  name="edit" id="edit" >edit</button></div>
               
           </div>
       </div>
   </form>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
</body>

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

</html>

<?php } ?>
