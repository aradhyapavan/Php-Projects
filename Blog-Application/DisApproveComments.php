<?php 

error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 

if(isset($_GET["id"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
  $Admin = $_SESSION["AdminName"];
  $sql = "UPDATE comments SET status='OFF', approvedby='$Admin' WHERE id='$SearchQueryParameter'";
  $Execute = $ConnectingDB->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="Comment Dis-Approved Successfully ! ";
    Redirect_to("Comments.php");

  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    Redirect_to("Comments.php");
  }
}
?>
