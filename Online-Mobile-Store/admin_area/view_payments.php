<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>


<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / View Payments

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->


<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"> </i> View Payments

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<div class="table-responsive"><!-- table-responsive Starts -->

<table class="table table-hover table-bordered table-striped"><!-- table table-hover table-bordered table-striped Starts -->

<thead><!-- thead Starts -->

<tr>

<th>Order No:</th>
<th>Invoice No:</th>
<th>Amount Paid:</th>
<th>Payment Method:</th>
<th>Customer Email</th>
<th>Product Name</th>

<th>Delete Payment:</th>

</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php

$i = 0;

$get_payments = "select * from customer_orders";

$run_payments = mysqli_query($con,$get_payments);

while($row_payments = mysqli_fetch_array($run_payments)){

$order_id = $row_payments['order_id'];

$invoice_no = $row_payments['invoice_no'];

$amount = $row_payments['amount'];

$payment_mode = $row_payments['payment_method'];

$c_email = $row_payments['c_email'];

$product_name = $row_payments['product_name'];



$i++;


?>


<tr>

<td><?php echo $order_id; ?></td>

<td bgcolor="yellow" ><?php echo $invoice_no; ?></td>

<td>$<?php echo $amount; ?></td>

<td><?php echo $payment_mode; ?></td>

<td><?php echo $c_email; ?></td>

<td><?php echo $product_name; ?></td>



<td>

<a href="index.php?payment_delete=<?php echo $payment_id; ?>" >

<i class="fa fa-trash-o" ></i> Delete

</a>

</td>


</tr>


<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-hover table-bordered table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->


<?php } ?>