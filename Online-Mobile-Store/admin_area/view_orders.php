<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts  --->

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / View Orders

</li>

</ol><!-- breadcrumb Ends  --->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->


<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"></i> View Orders

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<div class="table-responsive"><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>

<th>Order No:</th>
<th>Customer Email:</th>
<th>Invoice No:</th>
<th>Product Name:</th>
<th>Product Qty:</th>
<th>Address:</th>
<th>Order Date:</th>
<th>Total Amount:</th>
<th>Payment Method:</th>
<th>Delete Order:</th>


</tr>

</thead><!-- thead Ends -->


<tbody><!-- tbody Starts -->

<?php

$i = 0;

$get_orders = "select * from customer_orders";

$run_orders = mysqli_query($con,$get_orders);

while ($row_orders = mysqli_fetch_array($run_orders)) {

$order_id = $row_orders['order_id'];

$c_email = $row_orders['c_email'];

$invoice_no = $row_orders['invoice_no'];

$product_name = $row_orders['product_name'];

$qty = $row_orders['qty'];

$pay_method = $row_orders['payment_method'];

$order_date = $row_orders['order_date'];

$address=$row_orders['address'];

$order_date = $row_orders['order_date'];

$amount = $row_orders['amount'];


$i++;

?>

<tr>

<td><?php echo $order_id; ?></td>

<td>
<?php 

echo $c_email;
 ?>
 </td>

<td bgcolor="yellow" ><?php echo $invoice_no; ?></td>

<td><?php echo $product_name; ?></td>

<td><?php echo $qty; ?></td>

<td><?php echo $address; ?></td>

<td>
<?php

echo $order_date

?>
</td>

<td><?php echo $amount; ?> RS</td>

<td>
<?php

echo $pay_method

?>
</td>

<td>

<a href="index.php?order_delete=<?php echo $order_id; ?>" >

<i class="fa fa-trash-o" ></i> Delete

</a>

</td>


</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->


<?php } ?>