<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

?>
<!DOCTYPE html>
<html>

<head>
<title>E commerce Store </title>

<link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet" >

<link href="styles/bootstrap.min.css" rel="stylesheet">
    
      <link href="hide-show-fields-form.css" rel="stylesheet"/>
<script src="hide-show-fields-form.js"></script>

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

echo "<a href='customer/customer_login.php' >My Account</a>";

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

echo "<a href='customer/customer_login.php'> Login </a>";

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

<li>
<a href="filter.php"> Shop </a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='customer/customer_login.php' >My Account</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>My Account</a>";

}


?>
</li>

<li>
<a href="cart.php"> Shopping Cart </a>
</li>

<li >
<a href="contact.php"> Contact Us </a>
</li>

<li class="active" >
<a href="payment.php"> payment</a>
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

<li>Contact Us</li>

</ul><!-- breadcrumb Ends -->



</div><!--- col-md-12 Ends -->

<div class="col-md-3"><!-- col-md-3 Starts -->



</div><!-- col-md-3 Ends -->


<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='customer_login.php' ></a>";

}
else{







$session_email = $_SESSION['customer_email'];



$select_customer = "select * from customers where customer_email='$session_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$customer_email=$row_customer['customer_email'];
$customer_name = $row_customer['customer_name'];

}
?>



<div class="col-md-6" ><!-- col-md-9 Starts -->

<div class="box" ><!-- box Starts -->

<div class="box-header" ><!-- box-header Starts -->

<center><!-- center Starts -->

<h2>Payment </h2>

<p class="text-muted" >
If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.

</p>

</center><!-- center Ends -->

</div><!-- box-header Ends -->


<form action="payment.php" method="post" enctype="multipart/form-data" ><!-- form Starts -->

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($customer_name); ?>" / readonly>
  </div>

<div class="form-group"><!-- form-group Starts -->


<label>Email</label>

<input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($customer_email); ?>" / readonly>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Contact No </label>

<input type="text" class="form-control" name="contact" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Address </label>

<textarea class="form-control" name="address"> </textarea>

</div><!-- form-group Ends -->


  <div class="form-group">
    <label for="seeAnotherField">Payment Method</label>
    <select class="form-control" id="seeAnotherField" name="payment_method">
          <option value="no">COD</option>
          <option value="yes">Credit/Debit/Atm</option>
    </select>
  </div>

  <div class="form-group" id="otherFieldDiv">

<fieldset style="Margin:1px;">

    <legend>Card Details</legend>




                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control" placeholder="Valid Card Number" />
                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input type="tel" class="form-control" placeholder="MM / YY" />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label>CV CODE</label>
                                    <input type="tel" class="form-control" placeholder="CVC" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Card Holder Name</label>
                                    <input type="text" class="form-control" placeholder="cardholdername" />
                                </div>
                            </div>
                        </div>
                    

      </fieldset>
</div>
 
  <div class="text-center"><!-- text-center Starts -->

<button type="submit" name="place_order" class="btn btn-primary">

<i class="fa fa-user-md"></i> Place Order

</button>

</div><!-- text-center Ends -->

</form>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="hide-show-fields-form.js"></script>
  
  </body>
</html>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='customer_login.php'></a>";

}
else{


$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];



if(isset($_POST['place_order'])){


$name = $_POST['name'];

$email = $_POST['email'];

$contact = $_POST['contact'];

$address = $_POST['address'];

$payment_method = $_POST['payment_method'];

if($payment_method=='no'){

$payment_method = "COD";

}
else{

$payment_method = "Credit/Debit/Atm";

}


$ip_add = getRealUserIp();

$payment_method = "COD";

$invoice_no = mt_rand();

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);

while($row_cart = mysqli_fetch_array($run_cart)){

$pro_id = $row_cart['p_id'];


$pro_qty = $row_cart['qty'];

$select_product = "select * from product where product_id='$pro_id'";

$run_product = mysqli_query($con,$select_product);

while($row_product = mysqli_fetch_array($run_product)){

$product_name = $row_product['product_name'];


$get_products = "select * from product where product_id='$pro_id'";

$run_products = mysqli_query($con,$get_products);

while($row_products = mysqli_fetch_array($run_products)){

$sub_total = $row_products['product_price']*$pro_qty;


$insert_customer = "insert into customer_orders (customer_id,amount,invoice_no,qty,product_name,order_date,c_name,c_email,contact_no,address,payment_method) values ('$customer_id','$sub_total','$invoice_no','$pro_qty','$product_name',NOW(),'$name','$email','$contact','$address','$payment_method')";


$run_customer = mysqli_query($con,$insert_customer);



$delete_cart = "delete from cart where ip_add='$ip_add'";

$run_delete = mysqli_query($con,$delete_cart);
echo "<script>alert('Order Placed Successfully')</script>";



echo "<script>window.open('index.php','_self')</script>";


}

}
}

}
}

?>
