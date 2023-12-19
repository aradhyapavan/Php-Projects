<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
$_SESSION['login']='';
}
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard'; </script>";
} else{
    
    echo "<script>alert('Invalid Details');</script>";

}

}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bce Admin Portal </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Center.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div></div>
    <div class="container">
        <div class="row row-login">
            <div class="col-10 col-sm-6 col-md-4 offset-1 offset-sm-3 offset-md-4">
                <h1 class="text-center">Bce Admin Portal</h1>
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-danger">Admin Login </h3>
                        <form method="POST">
                            <div class="form-group"><label>Username </label><input class="form-control" type="text" name="username" id="username" autocomplete="off"></div>
                            <div class="form-group"><label>Password </label><input class="form-control" type="password" name="password" type="password" autocomplete="off"></div>
                            <div class="form-group">
                            </div><button class="btn btn-success btn-block" type="submit" name="login" id="login">LOGIN </button></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>