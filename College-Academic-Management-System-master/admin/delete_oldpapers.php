<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_GET['id']))
{
$id=$_GET['id'];
$get_file = "select * from oldpapers where id='$id'";

$run_file= mysqli_query($con,$get_file);

$row_file = mysqli_fetch_array($run_file);

$file_name=$row_file['files'];

$folder="question-papers/";
 
 $file_name=$folder."".$file_name;
unlink($file_name);


$sql = mysqli_query($con,"delete  from oldpapers where id='$id'");
if($sql)
{
$msg=" Question Papers deleted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

header('location:manage-question-papers');

}
?>