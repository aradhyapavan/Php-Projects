<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
  

	$usn=$_POST['USN'];
	$password=$_POST['password'];
	$sql ="SELECT USN,password FROM student WHERE USN=:usn and password=:password";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':usn', $usn, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  $_SESSION['login']=$_POST['USN'];
if($results)   
  {  
   if(!empty($_POST["remember"]))   
   {  
    setcookie ("USN",$usn,time()+ (10 * 365 * 24 * 60 * 60));  
    setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
  $_SESSION['login']=$_POST['USN'];
   }  
   else  
   {  
    if(isset($_COOKIE["USN"]))   
    {  
     setcookie ("USN","");  
    }  
    if(isset($_COOKIE["password"]))   
    {  
     setcookie ("password","");  
    }  
   }

 }
echo "<script type='text/javascript'> document.location ='student/student-profile'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bce Student Login-Form</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
  

</head>

<body>
    <div class="registration-form">
        <form method="post">
<h3 class="text-danger" style="text-align:center;"> Bce Student Login Form</h3>
            <div class="form-icon"><span><i class="icon-user icon"></i></span></div>
            <div class="form-group"><input class="form-control item" type="text" name="USN" id="USN" autocomplete="off"  value="<?php if(isset($_COOKIE["USN"])) { echo $_COOKIE["USN"]; } ?>" oninput="this.value = this.value.toUpperCase()" maxlength="15" placeholder="USN" ></div>
            <div class="form-group"><input class="form-control item" type="password" name="password" type="password" autocomplete="off" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="Password"></div>
           
 <div class="form-check"><input class="form-check-input" type="checkbox" name="remember" <?php if(isset($_COOKIE["USN"])) { ?> checked <?php } ?> /><label class="form-check-label" for="formCheck-1">Remember me to store your USN and Password in this Browser</label></div>
            <div class="form-group"><button class="btn btn-primary btn-block create-account" type="submit" name="login" id="login">Login</button></div>
                     <a class="btn btn-link center-block" role="button" href="forgot-password">Forget Password</a><a class="btn btn-link center-block" role="button" href="register">Register Now</a>
          
        </form>
        
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>