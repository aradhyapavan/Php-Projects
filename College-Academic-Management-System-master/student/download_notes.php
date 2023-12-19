<?php
session_start();
error_reporting(0);
include('includes/config.php');


if(isset($_GET['id']))
{
$id=$_GET['id'];


$get_file = "select * from notes where id='$id'";

$run_file= mysqli_query($con,$get_file);

$row_file = mysqli_fetch_array($run_file);




$type=$row_file['file_type'];
$size=$row_file['file_size'];
$file=$row_file['files'];

 echo "file name is:".$file;


$fileName = basename('$file');
$filePath = '../admin/notes/'.$file;
if(!empty($fileName) && file_exists($filePath)){
    // Define headers
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type:" .$type);
    header("Content-Transfer-Encoding: binary");
    
    
    readfile($filePath);
    exit;
}
else{
    echo 'The file does not exist.';
}
}
?>