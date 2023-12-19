<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

$id=intval($_GET['id']);




if(isset($_POST['submit']))
{


$get_file = "select * from notes where id='$id'";

$run_file= mysqli_query($con,$get_file);

$row_file = mysqli_fetch_array($run_file);


$oldfile=$row_file['files'];


$desc=$_POST['desc'];
$branch=$_POST['branch']; 
 
$sub=$_POST['sub']; 
$year=$_POST['year'];
$file=$_POST['file'];

$filePath = 'notes/'.$oldfile;
$filePath1='notes/'.$file;

rename($filepath,$filepath1);

$sql="update notes set branchid=:branchid,subjectcode=:sub,year=:year,files=:file,description=:des where id='$id'";
$query = $dbh->prepare($sql);
$query->bindParam(':branchid',$branch,PDO::PARAM_STR);
$query->bindParam(':sub',$sub,PDO::PARAM_STR);
$query->bindParam(':year',$year,PDO::PARAM_STR);
$query->bindParam(':file',$file,PDO::PARAM_STR);


$query->execute();

$msg="Student info updated successfully";
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BCE Admin Edit NOtes < </title>
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
                                    <h2 class="title">Edit Notes</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Edit Notes</li>
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
                                                    <h5>Fill the  info</h5>
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
<?php 

$sql = "SELECT tblsubjects.SubjectName,notes.id,notes.description,notes.year,notes.files,notes.subjectcode,tblclasses.branch_name,tblclasses.sem  from notes join tblclasses on tblclasses.id=notes.branchid join tblsubjects on tblsubjects.id=notes.subjectcode where notes.id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Description</label>
<div class="col-sm-10">
<input type="text" name="desc" class="form-control" id="desc" value="<?php echo htmlentities($result->description)?>" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Branch</label>
<div class="col-sm-10">
<input type="text" name="branch" class="form-control" id="branch" value="<?php echo htmlentities($result->branch_name)?>(<?php echo htmlentities($result->sem)?>)"  required="required" autocomplete="off" readonly>
</div>
</div>





                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Subject Name</label>
                                                        <div class="col-sm-10">
<input type="text" name="sub" class="form-control" id="sub" value="<?php echo htmlentities($result->SubjectName)?>" readonly>
                                                        </div>
                                                    </div>


<div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Year</label>
                                                        <div class="col-sm-10">
<input type="text" name="year" class="form-control" id="year" value="<?php echo htmlentities($result->year)?>" >
                                                        </div>
                                                    </div>

<div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">FIle Name</label>
                                                        <div class="col-sm-10">
 <input type="text" name="file" class="form-control" id="file" value="<?php echo htmlentities($result->files);?>">
                                                        </div>
                                                    </div>



<?php }} ?>                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
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
