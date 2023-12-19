<?php 
require_once("includes/config.php");

if(!empty($_POST["staffid"])) {
	$staff= $_POST["staffid"];

		$sql ="SELECT staff_id FROM staff WHERE staff_is=:staff";
$query= $dbh -> prepare($sql);
$query-> bindParam(':staff', $staff, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Satff Id already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Staff Id available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}

}


?>
