<?php
session_start();
error_reporting(0);
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;


   
if(!empty($_POST)) {
  
    

$source =$_POST['lang_src'] ;

$target=$_POST['lang_target'];
$text = $_POST['text'];

$trans = new GoogleTranslate();
$result1 = $trans->translate($source,$target,$text);
?>



 <div class="container pt-3 pb-3" style="background-color: black;">

    <div class="card text-center">
       <div class="card-header">
        Translated Text
        </div>
    <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text" id="pd"><?php echo($result1);?></p>
    </div>

</div>
<div class="text-center pt-3 pb-2 ">

<button class="btn btn-outline-primary bg-dark text-white" data-clipboard-target="#pd" id="btn1" type="button">
Copy to Clipboard
<span class="ml-1"><span class="fa fa-download"></span></span></button>
</div>


<?php
}
?>