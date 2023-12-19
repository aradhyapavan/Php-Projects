<?php 
error_reporting(0);
include("Includes/db.php"); 
 include("Includes/required.php"); 
 include("Includes/Sessions.php"); 

if(isset($_GET["id"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
  $sql = "DELETE FROM comments WHERE id='$SearchQueryParameter'";
  $Execute = $ConnectingDB->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="Comment Deleted Successfully ! ";
    Redirect_to("Comments.php");
    
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    Redirect_to("Comments.php");
  }
}
?>
