<?php


include("includes/db.php");

include("functions/functions.php");

?>

<?php

if(isset($_GET['c_id'])){

$customer_id = $_GET['c_id'];

}

$ip_add = getRealUserIp();

$status = "complete";

$payment_method="paypal";

$invoice_no = mt_rand();

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);

while($row_cart = mysqli_fetch_array($run_cart)){

$pro_id = $row_cart['p_id'];



$pro_qty = $row_cart['qty'];


$select_product = "select * from product where product_id='$pro_id'";

$run_product = mysqli_query($con,$select_product);

while($row_product = mysqli_fetch_array($run_product)){
$product_name=$row_product['product_name'];

$sub_total = $row_product['product_price']*$pro_qty;

$product_name=$row_product['product_name'];


$select_customer = "select * from customers where customer_id='$customer_id'";

$run_customer = mysqli_query($con,$select_customer);

while($row_customer = mysqli_fetch_array($run_customer)){

$c_name=$row_customer['customer_name'];

$c_email=$row_customer['customer_email'];




$insert_customer_order = "insert into customer_orders (customer_id,product_name,amount,invoice_no,qty,order_date,c_name,payment_method,c_email,order_status) values ('$customer_id','$product_name','$sub_total','$invoice_no','$pro_qty',NOW(),'$c_name','$payment_method','$c_email','$status')";

$run_customer_order = mysqli_query($con,$insert_customer_order);



$delete_cart = "delete from cart where ip_add='$ip_add'";

$run_delete = mysqli_query($con,$delete_cart);

echo "<script>alert('Your order has been submitted,Thanks ')</script>";

echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";


}
}

}

?>