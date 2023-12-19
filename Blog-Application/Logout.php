<?php 

error_reporting(0);
include("include/db.php"); 

include("include/required.php"); 
 include("include/Sessions.php"); 

$_SESSION["UserId"]=null;
$_SESSION["UserName"]=null;
$_SESSION["AdminName"]=null;
session_destroy();
Redirect_to("Login.php");
?>
