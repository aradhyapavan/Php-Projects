<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_GET['id']))
{
$id=$_GET['id'];
$get_file = "select * from links where id='$id'";

$run_file= mysqli_query($con,$get_file);

$row_file = mysqli_fetch_array($run_file);



$sql = mysqli_query($con,"delete  from links where id='$id'");
if($sql)
{
$msg=" Notes deleted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

header('location:manage-links');

}
?>