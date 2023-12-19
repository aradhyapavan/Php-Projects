<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>
<!DOCTYPE html>

<html>

<head>

<title> Insert Products </title>


<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

</head>

<body>

<div class="row"><!-- row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard"> </i> Dashboard / Insert Products

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- row Ends -->


<div class="row"><!-- 2 row Starts --> 

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Insert Products

</h3>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" > Product Name </label>

<div class="col-md-6" >

<input type="text" name="product_name" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Brand </label>

<div class="col-md-6" >

<input type="text" name="product_brand" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Price </label>

<div class="col-md-6" >

<input type="text" name="product_price" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Ram </label>

<div class="col-md-6" >

<input type="text" name="product_ram" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Storage </label>

<div class="col-md-6" >

<input type="text" name="product_storage" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Camera </label>

<div class="col-md-6" >

<input type="text" name="product_camera" class="form-control" required >

</div>

</div><!-- form-group Ends -->





<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" > Product Image 1 </label>

<div class="col-md-6" >

<input type="file" name="product_img1" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" > Product Image 2 </label>

<div class="col-md-6" >

<input type="file" name="product_img2" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" > Product Image 3 </label>

<div class="col-md-6" >

<input type="file" name="product_img3" class="form-control" required >

</div>
</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Quantity </label>

<div class="col-md-6" >

<input type="text" name="product_quantity" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Product Status </label>

<div class="col-md-6" >

<input type="text" name="product_status" class="form-control" required >

</div>

</div><!-- form-group Ends -->




<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Battery capacity </label>

<div class="col-md-6" >

<input type="text" name="battery_capacity" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Battery Type</label>

<div class="col-md-6" >

<input type="text" name="battery_type" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Operating System</label>

<div class="col-md-6" >

<input type="text" name="os" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Screen Resolution</label>

<div class="col-md-6" >

<input type="text" name="screen_resolution" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Screen Size</label>

<div class="col-md-6" >

<input type="text" name="screen_size" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Processor</label>

<div class="col-md-6" >

<input type="text" name="processor" class="form-control" required >

</div>

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->
<label class="col-md-3 control-label" > Sim Slots</label>

<div class="col-md-6" >

<input type="text" name="sim_slots" class="form-control" required >

</div>

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->

<label class="col-md-3 control-label" ></label>

<div class="col-md-6" >

<input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control" >

</div>

</div><!-- form-group Ends -->

</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends --> 




</body>

</html>

<?php

if(isset($_POST['submit'])){

$product_name = $_POST['product_name'];
$product_brand = $_POST['product_brand'];

$product_price = $_POST['product_price'];
$product_ram = $_POST['product_ram'];
$product_storage = $_POST['product_camera'];

$product_img1 = $_FILES['product_img1']['name'];
$product_img2 = $_FILES['product_img2']['name'];
$product_img3 = $_FILES['product_img3']['name'];

$temp_name1 = $_FILES['product_img1']['tmp_name'];
$temp_name2 = $_FILES['product_img2']['tmp_name'];
$temp_name3 = $_FILES['product_img3']['tmp_name'];

move_uploaded_file($temp_name1,"product_images/image/$product_img1");
move_uploaded_file($temp_name2,"product_images/image/$product_img2");
move_uploaded_file($temp_name3,"product_images/image/$product_img3");


$product_quantity = $_POST['product_quantity'];
$product_status = $_POST['product_status'];

$battery_capacity = $_POST['battery_capacity'];

$battery_type = $_POST['battery_type'];

$os = $_POST['os'];

$screen_resolution = $_POST['screen_resolution'];

$screen_size = $_POST['screen_size'];

$processor = $_POST['processor'];

$sim_slots = $_POST['sim_slots'];



$insert_product = "insert into product (product_name,product_brand,product_price,product_ram,product_storage,product_camera,product_img1,product_img2,product_img3,date,product_quantity,product_status,battery_capacity,battery_type,os,screen_resolution,screen_size,processor,sim_slots) values ('$product_name','$product_brand','$product_price','$product_ram','$product_storage','$product_camera','$product_img1','$product_img2','$product_img3',NOW(),'$product_quantity','$product_status','$battery_capacity','$battery_type','$os','$screen_resolution','$screen_size','$processor','$sim_slots')";

$run_product = mysqli_query($con,$insert_product);

if($run_product){

echo "<script>alert('Product has been inserted successfully')</script>";

echo "<script>window.open('index.php?view_products','_self')</script>";

}

}

?>

<?php } ?>
