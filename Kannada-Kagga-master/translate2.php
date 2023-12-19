<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

$id2=$_SESSION['id'];

$mk = "select * from mk where id='$id2'";


$mk1= mysqli_query($con,$mk);
$mk2 = mysqli_fetch_array($mk1);




$mkee=$mk2['mke'];


if(!empty($_POST["lang"]))
{ 

$source = 'en';

$target=$_POST["lang"];
$text = $mkee;

$trans = new GoogleTranslate();
$result1 = $trans->translate($source,$target,$text);
?>
<div class="container-fluid">
<div style="padding-bottom:10px;" class="text-center">

<div class="card-header">
            <h5 class="mb-0">Auto Translated Meaning</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo($result1);?></p>
        </div>
    </div>
 </div>


<?php

}
?>

