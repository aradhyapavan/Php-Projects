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

if(isset($_POST['submit']))
    {
$password=$_POST['password'];
$newpassword=$_POST['newpassword'];
$usn=$_SESSION['login'];


$student_session = $_SESSION['login'];

$get_student = "select * from student where USN='$student_session'";

$run_student= mysqli_query($con,$get_student);

$row_student = mysqli_fetch_array($run_student);

$sphoto = $row_student['StudentPhoto'];

$sname = $row_student['sname'];


$USN = $row_student['USN'];


    $sql ="SELECT password FROM student WHERE USN=:usn and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':usn', $usn, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update student set password=:newpassword where USN=:usn";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':usn', $usn, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong";    
}
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

  <title>BCE Student Change Password</title>

  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <link href="css/sb-admin.css" rel="stylesheet">

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">


    <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>


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
            <a href="ia-results">Change Password</a>
          </li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>    
                <div class="row " >
                  <div class="col-md-3"></div>
                  
                    <div class="col-md-6 border">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                         
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>

<h1 style="text-align:center;" class="border-bottom">Change Password </h1>
                        <div class="panel-body">
                       <form  method="post" onSubmit="return valid();" name="chngpwd >
                       
                             
<div class="form-group">
<label>Current Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>
</div><button class="btn btn-danger btn-block" type="submit" name="submit" id="submit" >Change</button>
  
</form>
                            </div>
                            </div>
                    </div>
                   
           

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
