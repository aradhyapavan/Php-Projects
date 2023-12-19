<?php
session_start();
error_reporting(0);
include('../includes/config.php');
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
 
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Center.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container">
        <div class="row row-login">
            <div class="col-10 col-sm-6 col-md-4 offset-1 offset-sm-3 offset-md-4">
                <h1 class="text-center">Web Application</h1>
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-danger">Mankuthimmana Kagga </h3>
                        <form  method="post" >
                            <div class="form-group">
      <label >Kagga Kannada</label>
      <textarea class="form-control" rows="10" name="mk" id="mk"></textarea>
    </div>
                     <div class="form-group">
      <label >English meaning</label>
      <textarea class="form-control" rows="12" name="mke" id="mke"></textarea>
    </div>
                            </div><button class="btn btn-success btn-block" type="submit" name="add" id="add">Add </button></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php

if(isset($_POST['add']))

{
$mk=$_POST['mk'];
$mke=$_POST['mke']; 
$sql="INSERT INTO  mk(mkk,mke) VALUES('$mk','$mke')";
$insert = mysqli_query($con,$sql);

if($insert)
{

echo "<script>alert('added Successfully')</script>";

echo "<script>window.open('index.php','_self')</script>";


}
else
{
echo "<script>alert('somthing went wrong')</script>";

}

}


?>

