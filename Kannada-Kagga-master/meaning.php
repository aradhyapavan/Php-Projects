
<?php
session_start();
error_reporting(0);
include('includes/config.php');



if (isset($_GET['id'])) {
    
    $id             = $_GET['id'];
    $_SESSION['id'] = $id;
    $mk             = "select * from mk where id='$id'";
    
    
    $mk1 = mysqli_query($con, $mk);
    $mk2 = mysqli_fetch_array($mk1);
    
    
    
    $id  = $mk2['id'];
    $mkk = $mk2['mkk'];
    $mke = $mk2['mke'];
    
    
    
    
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>ಮಂಕುತಿಮ್ಮನ ಕಗ್ಗ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<style> overflow-y: hidden; </style>

<script type="text/javascript">
  $(document).ready(function(){ 
    $("#lang").change(function(data){ 
      var lang = $(this).val();
       var dataString = "lang="+lang;

      $.ajax({ 
        type: "POST", 
        url: "translate2.php", 
        data: dataString, 
        success: function(result){ 
          $("#show").html(result); 
        }
      });

    });
  });
</script>

</head>
<body >

<?php
include('includes/nav.php');
?>
<br>
<div class="float-left"><span style="padding-left:10px;padding-bottom:10px;padding-top:-10%">

<i class='far fa-arrow-alt-circle-left' onclick="goBack()" style='font-size:36px'></i></span><br>

<script>
function goBack() {
  window.history.back();
}
</script></div><br><br>
<div class="container-fluid">
<div style="padding-bottom:10px;" class="text-center">


    <div class="card">
        <div class="card-header">
                 <h5 class="mb-0">ಕಗ್ಗ-<?php
    echo ($id);
?></h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?php
echo ($mkk);
?></p>
        </div>
    </div>

</div>



<div style="padding-bottom:10px;" class="text-center">


    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">English Meaning</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?php
echo ($mke);
?></p>
        </div>
    </div>

</div>



<div style="padding-bottom:10px;" class="text-center">


    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Auto Translated(English)</h5>
        </div><?php
include('eng-translate.php');
?>
        <div class="card-body">
            <p class="card-text"><?php
echo ($result2);
?></p>
        </div>
    </div>

</div>

<div style="padding-bottom:10px;" class="text-center">


    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">ಭಾವಾರ್ಥ(Auto Translated)</h5>
        </div>
<?php
include('translate.php');
?>
        <div class="card-body">
            <p class="card-text"><?php
echo ($result);
?></p>
        </div>
    </div>

</div>

<div class="container-fluid">
<div style="padding-bottom:10px;padding-top:10px;" class="text-center">

<div class="card-header">
            <h5 class="mb-0">English Meaning Will Be Auto Translated</h5>
        </div>
      
    </div>
 </div>
<div class="container-fluid">

<form method="post">
    <div class="form-group"  >
      <label style="padding-top:10px;" class="text-center"><h3>Choose Language For Translation<h3></label>
      <select class="form-control" name="lang" id="lang">
        <option value="" disabled selected Style="text-align:center;">Your Prefered Language</option>
       <option value="hi">Hindi</option>
        
 <option value="te">Telugu</option></div>
 <option value="ta">Tamil</option></div>
 <option value="ml">Malayalam</option></div>
 <option value="gu">Gujarati</option></div>
<option value="de">German</option></div>
 <option value="fr">French</option></div>
 <option value="ja">Japanese</option></div>
 <option value="el">Greek</option></div>
 <option value="pt-BR">Portuguese (Brazil)</option></div>
 <option value="nl">Dutch</option></div>
       
      </select></form></div>




<div id="show">
 

</div>







</body>
</html>

