<?php

$db = mysqli_connect("localhost","root","","mobistore");

/// IP address code starts /////
function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
/// IP address code Ends /////

/// add_cart function Starts /////

function add_cart(){
global $db;

if(isset($_GET['add_cart'])){

$ip_add = getRealUserIp();

$p_id = $_GET['add_cart'];

$product_qty = $_POST['product_qty'];

$check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";

$run_check = mysqli_query($db,$check_product);

if(mysqli_num_rows($run_check)>0){

echo "<script>alert('This Product is already added in cart')</script>";

echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

}
else {

$query = "insert into cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$product_qty')";

$run_query = mysqli_query($db,$query);

echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

}

}



}


/// add_cart function Ends /////


// items function Starts ///

function items(){

global $db;

$ip_add = getRealUserIp();

$get_items = "select * from cart where ip_add='$ip_add'";

$run_items = mysqli_query($db,$get_items);

$count_items = mysqli_num_rows($run_items);

echo $count_items;

}


// items function Ends ///

// total_price function Starts //

function total_price(){

global $db;

$ip_add = getRealUserIp();

$total = 0;

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($db,$select_cart);

while($record=mysqli_fetch_array($run_cart)){

$pro_id = $record['p_id'];

$pro_qty = $record['qty'];

$get_price = "select * from product where product_id='$pro_id'";

$run_price = mysqli_query($db,$get_price);

while($row_price=mysqli_fetch_array($run_price)){


$sub_total = $row_price['product_price']*$pro_qty;

$total += $sub_total;



}





}

echo "RS" . $total;



}



// total_price function Ends //


function getPro(){

global $db;

$get_product = "select * from product order by 1 DESC LIMIT 0,8";

$run_products = mysqli_query($db,$get_product);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_name'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

echo "

<div class='col-md-4 col-sm-6 single' >

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

}




?>