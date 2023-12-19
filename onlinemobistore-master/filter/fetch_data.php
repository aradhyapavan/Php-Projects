<?php

//fetch_data.php

session_start();


include("../includes/db.php");

include("../functions/functions.php");


if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM product WHERE product_status = '1'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND product_brand IN('".$brand_filter."')
		";
	}
	if(isset($_POST["ram"]))
	{
		$ram_filter = implode("','", $_POST["ram"]);
		$query .= "
		 AND product_ram IN('".$ram_filter."')
		";
	}
	if(isset($_POST["storage"]))
	{
		$storage_filter = implode("','", $_POST["storage"]);
		$query .= "
		 AND product_storage IN('".$storage_filter."')
		";
	}
global $db;

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '

				<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="background:#fff;
border: solid 1px #e6e6e6;
box-sizing: border-box;
margin-bottom: 30px;">




					<img src="../admin_area/product_images/image/'. $row['product_img1'] .'" alt="" class="img-responsive" >

			<p align="center"><strong><a href="../details.php?pro_id='. $row['product_id'] .'">'. $row['product_name'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['product_price'] .'</h4>
					<p style="text-align:center;">Camera : '. $row['product_camera'].' MP<br />
					Brand : '. $row['product_brand'] .' <br />
					RAM : '. $row['product_ram'] .' GB<br />
					Storage : '. $row['product_storage'] .' GB </p>
                                        <div style="clear:both;
text-align:center; margin-bottom:10px;">
<a href="../details.php?pro_id='. $row['product_id'] .'"><button type="button" class="btn btn-default">Buy Now</button></a>
                                        </div>






                                        				</div>

			</div>

			

			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>
