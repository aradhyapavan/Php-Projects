<?php

error_reporting(0);
include('includes/config.php');

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
</head>
<body>

<?php
include('includes/nav.php');
?>

<div class="container-fluid">
<h1  class="text-center">ಮಂಕುತಿಮ್ಮನ ಕಗ್ಗ</h1>

<?php


$mk = "select * from mk";


$mk1 = mysqli_query($con, $mk);

$cnt = 1;
while ($mk2 = mysqli_fetch_array($mk1)) {
    
    $id = $mk2['id'];
    
    $mkk = $mk2['mkk'];
    
    $mke = $mk2['mke'];
    
?>
<div style="padding-bottom:10px;" class="text-center">
  

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">ಕಗ್ಗ-<?php
    echo ($cnt);
?></h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?php
    echo ($mkk);
?></p>
        </div>
    </div>
<div style="padding-top:10px;" class="text-center">
<a href="meaning.php?id=<?php
    echo ($id);
?>">

<button type="button" class="btn btn-dark">Cannotation</button>
</a>

</div>

</div>

 
<?php
    $cnt = $cnt + 1;
}
?>


</div>






</body>
</html>

