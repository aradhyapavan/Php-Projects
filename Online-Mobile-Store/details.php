<?php

session_start();

include("includes/db.php");                       

include("functions/functions.php");                

?>

<?php

if(isset($_GET['pro_id'])){

$pro_id = $_GET['pro_id'];

$get_product = "select * from product where product_id='$pro_id'";

$run_product = mysqli_query($con,$get_product);

$row_product = mysqli_fetch_array($run_product);


$product_name = $row_product['product_name'];

$pro_price = $row_product['product_price'];



$product_img1 = $row_product['product_img1'];

$product_img2 = $row_product['product_img2'];

$product_img3 = $row_product['product_img3'];


}



?>

<!DOCTYPE html>
<html>

<head>
<title>E commerce Store </title>

<link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet" >

<link href="styles/bootstrap.min.css" rel="stylesheet">

<link href="styles/style.css" rel="stylesheet">

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

<div id="top"><!-- top Starts -->

<div class="container"><!-- container Starts -->

<div class="col-md-6 offer"><!-- col-md-6 offer Starts -->

<a href="#" class="btn btn-success btn-sm" >
<?php

if(!isset($_SESSION['customer_email'])){

echo "Welcome :Guest";


}else{

echo "Welcome : " . $_SESSION['customer_email'] . "";

}


?>
</a>

<a href="#">
Shopping Cart Total Price: <?php total_price(); ?>, Total Items <?php items(); ?>
</a>

</div><!-- col-md-6 offer Ends -->

<div class="col-md-6"><!-- col-md-6 Starts -->
<ul class="menu"><!-- menu Starts -->

<li>
<a href="customer_register.php">
Register
</a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >My Account</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>My Account</a>";

}


?>
</li>

<li>
<a href="cart.php">
Go to Cart
</a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php'> Login </a>";

}else {

echo "<a href='logout.php'> Logout </a>";

}

?>
</li>

</ul><!-- menu Ends -->

</div><!-- col-md-6 Ends -->

</div><!-- container Ends -->
</div><!-- top Ends -->

<div class="navbar navbar-default" id="navbar"><!-- navbar navbar-default Starts -->
<div class="container" ><!-- container Starts -->

<div class="navbar-header"><!-- navbar-header Starts -->

<a class="navbar-brand home" href="index.php" ><!--- navbar navbar-brand home Starts -->

<img src="images/aaa-small.jpg" alt="AAA logo" class="img-rounded" >
<img src="images/logo-small.png" alt="computerfever logo" class="visible-xs" >

</a><!--- navbar navbar-brand home Ends -->

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation"  >

<span class="sr-only" >Toggle Navigation </span>

<i class="fa fa-align-justify"></i>

</button>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search" >

<span class="sr-only" >Toggle Search</span>

<i class="fa fa-search" ></i>

</button>


</div><!-- navbar-header Ends -->

<div class="navbar-collapse collapse" id="navigation" ><!-- navbar-collapse collapse Starts -->

<div class="padding-nav" ><!-- padding-nav Starts -->

<ul class="nav navbar-nav navbar-left"><!-- nav navbar-nav navbar-left Starts -->

<li>
<a href="index.php"> Home </a>
</li>

<li class="active" >
<a href="filter/filter.php"> Shop </a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >My Account</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>My Account</a>";

}


?>
</li>

<li>
<a href="cart.php"> Shopping Cart </a>
</li>

<li>
<a href="contact.php"> Contact Us </a>
</li>

</ul><!-- nav navbar-nav navbar-left Ends -->

</div><!-- padding-nav Ends -->

<a class="btn btn-primary navbar-btn right" href="cart.php"><!-- btn btn-primary navbar-btn right Starts -->

<i class="fa fa-shopping-cart"></i>

<span> <?php items(); ?> items in cart </span>

</a><!-- btn btn-primary navbar-btn right Ends -->

<div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right Starts -->

<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">

<span class="sr-only">Toggle Search</span>

<i class="fa fa-search"></i>

</button>

</div><!-- navbar-collapse collapse right Ends -->

<div class="collapse clearfix" id="search"><!-- collapse clearfix Starts -->

<form class="navbar-form" method="get" action="results.php"><!-- navbar-form Starts -->

<div class="input-group"><!-- input-group Starts -->

<input class="form-control" type="text" placeholder="Search" name="user_query" required>

<span class="input-group-btn"><!-- input-group-btn Starts -->

<button type="submit" value="Search" name="search" class="btn btn-primary">

<i class="fa fa-search"></i>

</button>

</span><!-- input-group-btn Ends -->

</div><!-- input-group Ends -->

</form><!-- navbar-form Ends -->

</div><!-- collapse clearfix Ends -->

</div><!-- navbar-collapse collapse Ends -->

</div><!-- container Ends -->
</div><!-- navbar navbar-default Ends -->


<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->

<div class="col-md-12" ><!--- col-md-12 Starts -->

<ul class="breadcrumb" ><!-- breadcrumb Starts -->

<li>
<a href="index.php">Home</a>
</li>

<li><a href="filter/filter.php">Shop</a></li>



<li> <?php echo $product_name; ?> </li>

</ul><!-- breadcrumb Ends -->


</div><!--- col-md-12 Ends -->



<div class="col-md-12"><!-- col-md-9 Starts -->

<div class="row" id="productMain"><!-- row Starts -->

<div class="col-sm-6"><!-- col-sm-6 Starts -->

<div id="mainImage"><!-- mainImage Starts -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">

<ol class="carousel-indicators"><!-- carousel-indicators Starts -->

<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>

</ol><!-- carousel-indicators Ends -->

<div class="carousel-inner"><!-- carousel-inner Starts -->

<div class="item active">
<center>
<img src="admin_area/product_images/image/<?php echo $product_img1; ?>" class="img-responsive">
</center>
</div>

<div class="item">
<center>
<img src="admin_area/product_images/image/<?php echo $product_img2; ?>" class="img-responsive">
</center>
</div>

<div class="item">
<center>
<img src="admin_area/product_images/image/<?php echo $product_img3; ?>" class="img-responsive">
</center>
</div>

</div><!-- carousel-inner Ends -->

<a href="#myCarousel" class="left carousel-control" data-slide="prev"><!-- left carousel-control Starts -->

<span class="glyphicon glyphicon-chevron-left"> </span>

<span class="sr-only"> Previous </span>

</a><!-- left carousel-control Ends -->

<a class="right carousel-control" href="#myCarousel" data-slide="next"><!-- right carousel-control Starts -->

<span class="glyphicon glyphicon-chevron-right"> </span>

<span class="sr-only"> Next </span>

</a><!-- right carousel-control Ends -->

</div>

</div><!-- mainImage Ends -->

</div><!-- col-sm-6 Ends -->


<div class="col-sm-6" ><!-- col-sm-6 Starts -->

<div class="box" ><!-- box Starts -->

<h1 class="text-center" > <?php echo $product_name; ?> </h1>

<?php add_cart(); ?>

<form action="details.php?add_cart=<?php echo $pro_id; ?>" method="post" class="form-horizontal" ><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-5 control-label" >Product Quantity </label>

<div class="col-md-7" ><!-- col-md-7 Starts -->

<select name="product_qty" class="form-control" >

<option>Select quantity</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>


</select>

</div><!-- col-md-7 Ends -->

</div><!-- form-group Ends -->


<p class="price" > RS<?php echo $pro_price; ?> </p>

<p class="text-center buttons" ><!-- text-center buttons Starts -->

<button class="btn btn-primary" type="submit" >

<i class="fa fa-shopping-cart" ></i> Add to Cart

</button>

</p><!-- text-center buttons Ends -->

</form><!-- form-horizontal Ends -->

</div><!-- box Ends -->


<div class="row" id="thumbs" ><!-- row Starts -->

<div class="col-xs-4" ><!-- col-xs-4 Starts -->

<a href="#" class="thumb" >

<img src="admin_area/product_images/image/<?php echo $product_img1; ?>" class="img-responsive" >

</a>

</div><!-- col-xs-4 Ends -->

<div class="col-xs-4" ><!-- col-xs-4 Starts -->

<a href="#" class="thumb" >

<img src="admin_area/product_images/image/<?php echo $product_img2; ?>" class="img-responsive" >

</a>

</div><!-- col-xs-4 Ends -->

<div class="col-xs-4" ><!-- col-xs-4 Starts -->

<a href="#" class="thumb" >

<img src="admin_area/product_images/image/<?php echo $product_img3; ?>" class="img-responsive" >

</a>

</div><!-- col-xs-4 Ends -->


</div><!-- row Ends -->


</div><!-- col-sm-6 Ends -->


</div><!-- row Ends -->

<div class="box" id="details"><!-- box Starts -->

<p><!-- p Starts -->

<h4>Product details</h4>

<div class="panel-body" ><!-- panel-body Starts -->

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

<?php



$get_pro = "select * from product where product_id='$pro_id'";

$run_pro = mysqli_query($con,$get_pro);

while($row_pro=mysqli_fetch_array($run_pro)){

$product_brand = $row_pro['product_brand'];

$product_ram = $row_pro['product_ram'];

$product_storage = $row_pro['product_storage'];

$product_camera = $row_pro['product_camera'];

$battery_capacity = $row_pro['battery_capacity'];

$battery_type = $row_pro['battery_type'];

$os = $row_pro['os'];

$screen_resolution = $row_pro['screen_resolution'];

$screen_size = $row_pro['screen_size'];

$processor = $row_pro['processor'];
$sim_slots = $row_pro['sim_slots'];



?>
<tbody>



<tr>
<th>Brand</th>
<td><?php echo $product_brand; ?></td>
</tr>

<tr>
<th>Ram</th>
<td><?php echo $product_ram; ?></td>
</tr>

<tr>
<th>Storage</th>
<td><?php echo $product_storage; ?></td>
</tr>
<tr>
<th>Camera</th>
<td><?php echo $product_camera; ?></td>
</tr>
<tr>
<th>Battery capacity</th>
<td><?php echo $battery_capacity; ?></td>
</tr>
<tr>
<th>Battery Type</th>
<td><?php echo $battery_type; ?></td>
</tr>

<tr>
<th>Operating System</th>
<td><?php echo $os; ?></td>
</tr>


<tr>
<th>Screen Resolution</th>
<td><?php echo $screen_resolution; ?></td>
</tr>

<tr>
<th>Screen Size</th>
<td><?php echo $screen_size; ?></td>
</tr>

<tr>
<th>Processor</th>
<td><?php echo $processor; ?></td>
</tr>

<tr>
<th>Sim Slots</th>
<td><?php echo $sim_slots; ?></td>
</tr>


</tbody>


</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->



</p>
</div>





<div id="hot"><!-- hot Starts -->

<div class="box"><!-- box Starts -->

<div class="container"><!-- container Starts -->

<div class="col-md-12"><!-- col-md-12 Starts -->

<h2>You also like These products</h2>

</div><!-- col-md-12 Ends -->

</div><!-- container Ends -->

</div><!-- box Ends -->

</div><!-- hot Ends -->



<?php

global $db;

$get_product = "select * from product order by 1 DESC LIMIT 0,4";

$run_products = mysqli_query($db,$get_product);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_name'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

echo "

<div class='col-md-1 col-sm-4 single' >

<div class='product' >

<a href='details.php?pro_id=$pro_id' >

<img src='admin_area/product_images/image/$pro_img1' class='img-responsive' >

</a>

<div class='text' >

<h3><a href='details.php?pro_id=$pro_id' >$pro_title</a></h3>

<p class='price' >$pro_price RS</p>

<p class='buttons' >

<a href='details.php?pro_id=$pro_id' class='btn btn-default' >View details</a>

<a href='details.php?pro_id=$pro_id' class='btn btn-primary'>

<i class='fa fa-shopping-cart'></i> Add to cart

</a>


</p>

</div>


</div>

</div>

";

}


?>





</div><!-- row same-height-row Ends -->

</div><!-- col-md-9 Ends -->

</div><!-- container Ends -->

</div><!-- content Ends -->

<?php

include("includes/footer.php");
?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>