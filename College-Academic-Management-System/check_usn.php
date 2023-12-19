<?php 
require_once("includes/config.php");

if(!empty($_POST["USN"])) {
	$usn= $_POST["USN"];

		$sql ="SELECT USN FROM student WHERE USN=:USN";
$query= $dbh -> prepare($sql);
$query-> bindParam(':USN', $usn, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Usn already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> USN available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}

}


?>
