<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['upload']))
{
$description=$_POST['des'];
$Branch=$_POST['Branch'];
$sub=$_POST['subject']; 
$year=$_POST['year']; 


$files = $_FILES['file']['name'];

$files_tmp = $_FILES['file']['tmp_name'];

$file_type = $_FILES['file']['type'];

$file_size = $_FILES['file']['size']*0.000001;
 


 

move_uploaded_file($files_tmp,"../admin/notes/$files");








$ret=mysqli_query($con,"insert into notes(description,branchid,subjectcode,year,file_type,file_size,files) values('$description','$Branch','$sub','$year','$file_type','$file_size','$files')");


if($ret)
{
$msg=" Notes Uploaded successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BCE Admin notes </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>

 <script>
function getStudent(val) {
 $.ajax({
        type: "POST",
        url: "get_student_subject.php",
        data:'Branchid1='+val,
        success: function(data){
            $("#subject").html(data);
            
        }
        });
}
</script>
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
                                    <h2 class="title">Add Notes</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Notes</li>
                                        <li class="active">Add Digital Notes</li>
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
                                                    <h5>Add Notes</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh oops!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                                                   

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Description</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="des" id="des"  required="required" autocomplete="off">
</div>
</div>



 <div class="form-group">
<label for="default" class="col-sm-2 control-label">Branch</label>
 <div class="col-sm-10">
 <select name="Branch" class="form-control clid" id="Branchid" onChange="getStudent(this.value);" required="required">
<option value="">Select Branch</option>
<?php $sql = "SELECT * from tblclasses";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->branch_name); ?>&nbsp; -<?php echo htmlentities($result->sem); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>




<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Subject Name</label>
                                                        <div class="col-sm-10">
                                                    <select name="subject" class="form-control stid" id="subject" required="required" onChange="getresult(this.value);"><option value="">Select Subject</option>
                                                    </select>
                                                        </div>
                                                    </div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Year</label>
<div class="col-sm-10">
<input type="number"  class="form-control" name="year" id="year"  required="required" autocomplete="off">
</div>
</div>




<div class="form-group">
<label for="default" class="col-sm-2 control-label">Upload Files</label>
<div class="col-sm-10">
<input type="file"  class="form-control" name="file" id="file"  required="required" autocomplete="off"></br>
 <span class="help-block" style="color:red;"><b>Note:Rename File-name  as "subject-name/dd-mm-year-time"   Eg:-"web-technology/15-9-2019-4:11" and then upload</b></span>
</div>
</div>


                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="upload" id="upload"class="btn btn-primary">Add</button>
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
