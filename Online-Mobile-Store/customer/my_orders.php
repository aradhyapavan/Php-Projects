
<center><!-- center Starts -->

<h1>My Orders</h1>

<p class="lead"> Your orders on one place.</p>

<p class="text-muted" >

If you have any questions, please feel free to <a href="../contact.php" > contact us,</a> our customer service center is working for you 24/7.


</p>


</center><!-- center Ends -->

<hr>

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover" ><!-- table table-bordered table-hover Starts -->

<thead><!-- thead Starts -->

<tr>

<th>O N:</th>
<th>Amount:</th>
<th>Invoice No:</th>
<th>Qty:</th>
<th>Product Name:</th>
<th>Order Date:</th>
<th>Payment Method:</th>



</tr>

</thead><!-- thead Ends -->

<tbody><!--- tbody Starts --->

<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$get_orders = "select * from customer_orders where customer_id='$customer_id'";

$run_orders = mysqli_query($con,$get_orders);


$i = 1;

while($row_orders = mysqli_fetch_array($run_orders)){

$order_id = $row_orders['order_id'];

$amount = $row_orders['amount'];

$invoice_no = $row_orders['invoice_no'];

$qty = $row_orders['qty'];

$product_name = $row_orders['product_name'];

$order_date = substr($row_orders['order_date'],0,11);

$payment_method = $row_orders['payment_method'];






?>

<tr><!-- tr Starts -->

<th><?php echo $i; ?></th>

<td>RS<?php echo $amount; ?></td>

<td><?php echo $invoice_no; ?></td>

<td><?php echo $qty; ?></td>

<td><?php echo $product_name; ?></td>

<td><?php echo $order_date; ?></td>

<td><?php echo $payment_method; ?></td>



</tr><!-- tr Ends -->

<?php } ?>

</tbody><!--- tbody Ends --->


</table><!-- table table-bordered table-hover Ends -->

</div><!-- table-responsive Ends -->



