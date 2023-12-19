
<div id="footer"><!-- footer Starts -->
<div class="container"><!-- container Starts -->

<div class="row" ><!-- row Starts -->

<div class="col-md-3 col-sm-6" ><!-- col-md-3 col-sm-6 Starts -->

<h4>Pages</h4>

<ul><!-- ul Starts -->

<li><a href="cart.php">Shopping Cart</a></li>

<li><a href="contact.php">Contact Us</a></li>

<li><a href="filter/filter.php">Shop</a></li>

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


</ul><!-- ul Ends -->
</div><!-- col-md-3 col-sm-6 Ends -->

<div class="col-md-3 col-sm-6">


<h4>User Section</h4>

<ul><!-- ul Starts -->

<li>

<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >Login</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>My Account</a>";

}


?>

</li>

<li><a href="customer_register.php">Register</a></li>

</ul><!-- ul Ends -->


</div>



<div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->

<h4>About  us</h4>

<p><!-- p Starts -->
<strong>AAA Mobile Cart</strong>
<br>online Mobile Store
<br>9743910708
<br>acubemobicart@gmail.com
<br>

</p><!-- p Ends -->

<a href="contact.php">Go to Contact us page</a>

<hr class="hidden-md hidden-lg">

</div><!-- col-md-3 col-sm-6 Ends -->


<h4> Stay in touch </h4>

<p class="social"><!-- social Starts --->

<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
<a href="#"><i class="fa fa-google-plus"></i></a>
<a href="#"><i class="fa fa-envelope"></i></a>

</p><!-- social Ends --->



</div><!-- col-md-3 col-sm-6 Ends -->

</div><!-- row Ends -->

</div><!-- container Ends -->
</div><!-- footer Ends -->


<div class="col-md-6" ><!-- col-md-6 Starts -->

<p class="pull-left">  </p>

</div><!-- col-md-6 Ends -->

<div id="copyright"><!-- copyright Starts -->

<div class="col-md-6" ><!-- col-md-6 Starts -->

<p class="center" >

<center>Designed and Developed by<a href="http://www.onlinemobistore.ihostfull.com" >--Online Mobile Store Web development Team</center></a>

</p>


</div><!-- col-md-6 Ends -->

</div><!-- container Ends -->

</div><!-- copyright Ends -->

