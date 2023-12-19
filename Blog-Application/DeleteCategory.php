<?php 
error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 

if(isset($_GET["id"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
  $sql = "DELETE FROM category WHERE id='$SearchQueryParameter'";
  $Execute = $ConnectingDB->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="Category Deleted Successfully ! ";
    Redirect_to("Categories.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    Redirect_to("Categories.php");
  }
}
?>
