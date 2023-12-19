<?php
session_start();
error_reporting(0);
include('includes/config.php');


if(isset($_GET['id']))
{
$id=$_GET['id'];


$sql = "SELECT * from oldpapers where id=?";
$query = $dbh -> prepare($sql);
$query->execute();
$data=$query->fetch();



$file='../admin/question-papers/'.$data['files'];

if(file_exists($file))
{
 header('content-type:'.$data['file_type']);
header('content-length:'.$filesize($file);
readfile($file);
exit;
}
}
?>