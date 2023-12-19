<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
    $marks=array();
$Branch=$_POST['Branch'];
$iatype=$_POST['iatype'];
$sid=$_POST['sid']; 
$mark=$_POST['marks'];

 $stmt = $dbh->prepare("SELECT StudentName,StudentId FROM tblstudents WHERE BranchId= :bid order by StudentName");
 $stmt->execute(array(':bid' => $Branch));
  $studentid1=array();
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {

array_push($studentid1,$row['StudentId']);
   } 
  
for($i=0;$i<count($mark);$i++){
    $mar=$mark[$i];
  $studentid=$studentid1[$i];
$sql="INSERT INTO  tbliaresult(StudentId,BranchId,iatype,SubjectId,marks) VALUES(:studentid,:Branch,:iatype,:sid,:marks)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':Branch',$Branch,PDO::PARAM_STR);
$query->bindParam(':iatype',$iatype,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':marks',$mar,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Result info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
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
        <title> Admin Add  IA Result </title>
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

function getStudent1(val,clid) {
var clid=$(".clid").val();
var val=$(".year").val();;
var abh=clid+'$'+val;
//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student_subject.php",
        data:'studclass='+abh,
        success: function(data){
            $("#studentid").html(data);
            
        }
        });
}



    </script>
<script>

function getresult(iatype,val,clid) 
{   
    
var clid=$(".clid").val();
var val=$(".stid").val();
var iatype=$(".iatype").val();
var abh=clid+'$'+val+'$'+iatype;

//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student_subject.php",
        data:'studclass='+abh,
        success: function(data){
            $("#reslt").html(data);
            
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
                                    <h2 class="title">Declare IA Result</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student IA Result</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                           
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
                                                        <label class="col-sm-2 control-label ">Year</label>
                                                        <div class="col-sm-10">
                                                       <select name="year" id="year" class="form-control year" onChange="getStudent1(this.value);" required="required">
                                                         <option>Select Year</option>
                                                     <option>2019</option>
                                                     <option>2020</option> 
                                                        <option>2021</option> </select>
                                                        </div>
                                                    </div>



<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Subject Name</label>
                                                        <div class="col-sm-10">
                                                    <select name="sid" class="form-control stid" id="subject" required="required" onChange="getresult(this.value);"><option value="">Select Subject</option>
                                                    </select>
                                                        </div>
                                                    </div>

                                                  
<div class="form-group">
                                                        <label class="col-sm-2 control-label ">Ia Type</label>
                                                        <div class="col-sm-10">
                                                       <select name="iatype"  class="form-control iatype" id="iatype" onChange="getresult(this.value);" required="required">
                                                         <option>Select Ia Type</option>
                                                     <option>first</option>
                                                     <option>second</option> 
                                                        <option>third</option> </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                      
                                                        <div class="col-sm-10">
                                                    <div  id="reslt">
                                                    </div>
                                                        </div>
                                                    </div>
                                                    
<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">Students</label>
                                                        <div class="col-sm-10">
                                                    <div  id="studentid">
                                                    </div>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Declare IA Result</button>
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
