<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bce Student Register Form</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
<script>
function checkUsn() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_usn.php",
data:'USN='+$("#USN").val(),
type: "POST",
success:function(data){
$("#usn-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>    



<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>    



</head>
<div class="registration-form">
     
                        <form  method="post" enctype="multipart/form-data">
<h3 class="text-danger" style="text-align:center;"> Bce Student Register Form</h3>
<div style="padding-top:10px;"></div>
            <div class="form-icon"><span><i class="icon-user icon"></i></span></div>
            <div class="form-group"><input class="form-control item" type="text" name="sname" id="sname" autocomplete="off" placeholder="Student Name" required></div>




            <div class="form-group">
<input class="form-control item" type="text" name="USN" id="USN" maxlength="15" onBlur="checkUsn()" pattern="[4BB]{3}[1-9]{2}[A-Z]{2}[0-9]{3}" autocomplete="off" oninput="this.value = this.value.toUpperCase()" placeholder="USN" required>
  <span id="usn-availability-status" style="font-size:12px;"></span>
</div>
            <div class="form-group"><input class="form-control item" type="email" name="email" id="email" onBlur="checkAvailability()"  autocomplete="off" placeholder="someone@mail.com" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>
            <div class="form-group"><input class="form-control item" type="password" name="password" id="password"  autocomplete="off" placeholder="Password" required></div>

         <div class="form-group"><input class="form-control item"  type="password" name="confirmpassword" autocomplete="off"  placeholder=" Confirm Password"  required  />
    <span id='message'></span></div>


       <div class="form-group"><input class="form-control item" type="text" name="mobile_no" id="mobile_no" maxlength="10" autocomplete="off" placeholder="Mobile Number" required /></div>


  <div class="form-group">

<select class="form-control item" style="height:40px;" name="branch" id="branch" placeholder="select Branch"  required="required">
<option>Select Branch</option>
<option>Computer Science</option>
<option>Informtion Science</option>
<option>Civil</option>
<option>Mechanical</option>
<option>Electonic and Communication</option> 
</select>

</div>

<div class="form-group">
    
    
   <select name="scheme" id="scheme" class="form-control item" style="height:40px;"  required="required">
<option>Select Schemes</option>
<option>2015</option>
<option>2017</option> </select> 
  </div> 

  <div class="form-group">

<label >DOB </label>
<input type="date" class="form-control item" name="dob" id="dob" placeholder="Dob"></div>

  
<div class="form-group">
<label >Gender:    </label>

<input type="radio" name="gender" id="gender" value="Male" required="required" checked="">Male <input type="radio" name="gender" id="gender" value="Female" required="required">Female 
</div>


             <div class="form-group"><button class="btn btn-primary btn-block create-account" type="submit" name="submit" id="submit">Register</button></div>
         <a class="btn btn-link center-block" role="button" href="forgot-password">Forget Password</a><a class="btn btn-link center-block" role="button" href="index">Signin Instead</a>
          
        </form>
       
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
     <?php

if(isset($_POST['submit']))

{
$sname=$_POST['sname'];
$USN=$_POST['USN']; 

$email=$_POST['email'];
$password=$_POST['password']; 
$mobile_no=$_POST['mobile_no']; 
$branch=$_POST['branch'];
$scheme=$_POST['scheme'];

$dob=$_POST['dob']; 
$gender=$_POST['gender'];
$status=1;
$sql="INSERT INTO  student(sname,USN,s_email,password,mobile_no,branch,scheme,DOB,Gender,Status) VALUES('$sname','$USN','$email','$password','$mobile_no','$branch','$scheme','$dob','$gender','$status')";
$insert = mysqli_query($con,$sql);

if($insert)
{

echo "<script>alert('You have been Registered Successfully')</script>";

echo "<script>window.open('index.php','_self')</script>";


}
else
{
echo "<script>alert('somthing went wrong')</script>";

}

}


?>

