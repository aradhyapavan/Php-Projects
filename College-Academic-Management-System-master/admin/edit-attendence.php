<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

$stid=intval($_GET['stid']);
if(isset($_POST['submit']))
{

$rowid=$_POST['id'];
$tct=$_POST['tct'];
$marks=$_POST['marks']; 

foreach($_POST['id'] as $count => $id){
$mrks=$marks[$count];
$iid=$rowid[$count];
for($i=0;$i<=$count;$i++) {

$sql="update attendence  set TCT=:tct,TCA=:mrks where id=:iid and iatype='first' ";
$query = $dbh->prepare($sql);
$query->bindParam(':tct',$tct,PDO::PARAM_STR);
$query->bindParam(':mrks',$mrks,PDO::PARAM_STR);
$query->bindParam(':iid',$iid,PDO::PARAM_STR);
$query->execute();

$msg=" Attendence updated successfully";
}



}
}

if(isset($_POST['submit1']))
{

$rowid=$_POST['id'];
$tct1=$_POST['tct1'];
$marks=$_POST['marks']; 

foreach($_POST['id'] as $count => $id){
$mrks=$marks[$count];
$iid=$rowid[$count];
for($i=0;$i<=$count;$i++) {

$sql="update attendence  set TCT=:tct,TCA=:mrks where id=:iid and iatype='second'";
$query = $dbh->prepare($sql);
$query->bindParam(':tct',$tct1,PDO::PARAM_STR);
$query->bindParam(':mrks',$mrks,PDO::PARAM_STR);
$query->bindParam(':iid',$iid,PDO::PARAM_STR);
$query->execute();

$msg=" Attendence updated successfully";
}



}
}

if(isset($_POST['submit2']))
{

$rowid=$_POST['id'];
$tct2=$_POST['tct2'];
$marks=$_POST['marks']; 

foreach($_POST['id'] as $count => $id){
$mrks=$marks[$count];
$iid=$rowid[$count];
for($i=0;$i<=$count;$i++) {

$sql="update attendence  set TCT=:tct,TCA=:mrks where id=:iid and iatype='third'";
$query = $dbh->prepare($sql);
$query->bindParam(':tct',$tct2,PDO::PARAM_STR);
$query->bindParam(':mrks',$mrks,PDO::PARAM_STR);
$query->bindParam(':iid',$iid,PDO::PARAM_STR);
$query->execute();

$msg=" Attendence updated successfully";
}



}
}




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BCE Admin Attendence < </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Attendence Info</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Attendence Info</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Update Attendence info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

<h5 style="text-align:center;">Attendence Details During First IA</h5>

<?php 

$ret = "SELECT tblstudents.StudentName,tblclasses.branch_name,tblclasses.sem from attendence join tblstudents on attendence.StudentId=attendence.StudentId join tblsubjects on tblsubjects.id=attendence.SubjectId join tblclasses on tblclasses.id=tblstudents.BranchId where tblstudents.StudentId=:stid limit 1";
$stmt = $dbh->prepare($ret);
$stmt->bindParam(':stid',$stid,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($result as $row)
{  ?>


                                                    <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Branch:-</label>
                                                        <div class="col-sm-10">
                          <?php echo htmlentities($row->branch_name)?>
                                                        </div>
                                                    </div>

 <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Sem:-</label>
                                                        <div class="col-sm-10">
<?php echo htmlentities($row->sem)?>
                                                        </div>
                                                    </div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Full Name</label>
<div class="col-sm-10">
<?php echo htmlentities($row->StudentName);?>
</div>
</div>
<?php } }?>


<?php 
$sql = "SELECT distinct tblstudents.StudentName,tblstudents.StudentId,tblclasses.branch_name,tblclasses.sem,tblsubjects.SubjectName,attendence.TCT,attendence.TCA,attendence.id as resultid from attendence join tblstudents on tblstudents.StudentId=attendence.StudentId join tblsubjects on tblsubjects.id=attendence.SubjectId join tblclasses on tblclasses.id=tblstudents.BranchId where tblstudents.StudentId=:stid and attendence.iatype='first' ";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Total CLasses Taken</label>
<div class="col-sm-10">
<input type="text" name="tct" id="tct" class="form-control" value="<?php echo htmlentities($result->TCT)?>">
</div>
</div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label"><?php echo htmlentities($result->SubjectName)?></label>
<div class="col-sm-10">
<input type="hidden" name="id[]" value="<?php echo htmlentities($result->resultid)?>">
<input type="text" name="marks[]" class="form-control" id="marks" value="<?php echo htmlentities($result->TCA)?>" maxlength="5" required="required" autocomplete="off">
</div>
</div>




<?php }} ?>      


                                              

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>



<h5 style="text-align:center;">Attendence Details During Second IA</h5>

<?php 
$sql = "SELECT distinct tblstudents.StudentName,tblstudents.StudentId,tblclasses.branch_name,tblclasses.sem,tblsubjects.SubjectName,attendence.TCT,attendence.TCA,attendence.id as resultid from attendence join tblstudents on tblstudents.StudentId=attendence.StudentId join tblsubjects on tblsubjects.id=attendence.SubjectId join tblclasses on tblclasses.id=tblstudents.BranchId where tblstudents.StudentId=:stid and attendence.iatype='second' ";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Total CLasses Taken</label>
<div class="col-sm-10">
<input type="text" name="tct1" id="tct1" class="form-control" value="<?php echo htmlentities($result->TCT)?>">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label"><?php echo htmlentities($result->SubjectName)?></label>
<div class="col-sm-10">
<input type="hidden" name="id[]" value="<?php echo htmlentities($result->resultid)?>">
<input type="text" name="marks[]" class="form-control" id="marks" value="<?php echo htmlentities($result->TCA)?>" maxlength="5" required="required" autocomplete="off">
</div>
</div>




<?php }}  ?>      



                                           

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit1" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>


<h5 style="text-align:center;">Attendence Details During Final IA</h5>




<?php 
$sql = "SELECT distinct tblstudents.StudentName,tblstudents.StudentId,tblclasses.branch_name,tblclasses.sem,tblsubjects.SubjectName,attendence.TCT,attendence.TCA,attendence.id as resultid from attendence join tblstudents on tblstudents.StudentId=attendence.StudentId join tblsubjects on tblsubjects.id=attendence.SubjectId join tblclasses on tblclasses.id=tblstudents.BranchId where tblstudents.StudentId=:stid and attendence.iatype='third' ";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Total CLasses Taken</label>
<div class="col-sm-10">
<input type="text" name="tct2" id="tct2" class="form-control" value="<?php echo htmlentities($result->TCT)?>">
</div>
</div>
<div class="form-group">
<label for="default" class="col-sm-2 control-label"><?php echo htmlentities($result->SubjectName)?></label>
<div class="col-sm-10">
<input type="hidden" name="id[]" value="<?php echo htmlentities($result->resultid)?>">
<input type="text" name="marks[]" class="form-control" id="marks" value="<?php echo htmlentities($result->TCA)?>" maxlength="5" required="required" autocomplete="off">
</div>
</div>




<?php }} ?>                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit2" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
