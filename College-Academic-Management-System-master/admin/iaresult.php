<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IA Results</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body>
        <div class="main-wrapper">
            <div class="content-wrapper">
                <div class="content-container">

         
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-12">
                                    <h2 class="title" align="center">IA Results</h2>
                                </div>
                            </div>
                            <!-- /.row -->
                          
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                              
                             

                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">

<?php
// code Student Data
$USN=$_POST['USN'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];

$get_student = "select * from tblclasses where branch_name='$branch' and sem='$sem'";

$run_student= mysqli_query($con,$get_student);

$row_student = mysqli_fetch_array($run_student);

$Branchid = $row_student['id'];


$_SESSION['USN']=$USN;
$_SESSION['Branchid']=$Branchid;


$qery = "SELECT   tblstudents.StudentName,tblstudents.USN,tblstudents.StudentId,tblclasses.branch_name,tblclasses.sem from tblstudents join tblclasses on tblclasses.id=tblstudents.BranchId where tblstudents.USN=:USN and tblstudents.BranchId=:Branchid ";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':USN',$USN,PDO::PARAM_STR);
$stmt->bindParam(':Branchid',$Branchid,PDO::PARAM_STR);
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{   ?>
<p><b> Name :</b> <?php echo htmlentities($row->StudentName);?></p>
<p><b>USN :</b> <?php echo htmlentities($row->USN);?>
<p><b> Branch:</b> <?php echo htmlentities($row->branch_name);?>
<p><b> Sem:</b> <?php echo htmlentities($row->sem);?>
<?php }

    ?>
                                            
</div>
                                            <div class="panel-body p-20">







                                                <table class="table table-hover table-bordered">
                                                <thead>
                                                                                                            <tr>
                                                            
                                                            <th >Subject</th>
                                                               
                                                            <th >First IA</th>
                                                            <th >Second IA</th>
                                                             <th >Third IA</th>
                                                             <th>Average</th>
                                                             </tr>
<tr>
                                               </thead>
  


                                                	
                                                	<tbody>

<?php                                              
// Code for result
$iatype="first";
 $query ="select t.StudentName,t.USN,t.BranchId,t.marks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.USN,sts.BranchId,tr.marks,SubjectId from tblstudents as sts join  tbliaresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where t.USN=:USN and t.BranchId=:Branchid and iaresults.iatype=:first";
$query= $dbh -> prepare($query);
$query->bindParam(':USN',$USN,PDO::PARAM_STR);
$query->bindParam(':Branchid',$Branchid,PDO::PARAM_STR);
$query->bindParam(':first',$iatype,PDO::PARAM_STR);
$query-> execute();  
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 

foreach($results as $result){

    ?>

                                                		<tr>
                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                			<td><?php echo htmlentities($result->SubjectName);?></td>
                                                			<td><?php echo htmlentities($result->marks);?></td>
                                                            <td></td>
                                                            <td></td>
                                                		</tr>


 <?php } }?>     




                                                	</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                   
                                    <div class="form-group">
                                                           
                                                            <div class="col-sm-6">
                                                               <a href="../index.php">Back to Home</a>
                                                            </div>
                                                        </div>
                                                           
                                                          

                                </div>
                                <!-- /.row -->
  
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                  
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {

            });
 <?php                                              
// Code for result

 $query ="select t.StudentName,t.USN,t.BranchId,t.marks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.USN,sts.BranchId,tr.marks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.USN=:USN and t.BranchId=:Branchid)";
$query= $dbh -> prepare($query);
$query->bindParam(':USN',$USN,PDO::PARAM_STR);
$query->bindParam(':Branchid',$Branchid,PDO::PARAM_STR);
$query-> execute();  
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 

foreach($results as $result){

    ?>

                                                		<tr>
                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                			<td><?php echo htmlentities($result->SubjectName);?></td>
                                                			<td><?php echo htmlentities($totalmarks=$result->marks);?></td>
                                                		</tr>
<?php 
$totlcount+=$totalmarks;
$cnt++;}
?>
<tr>
                                                <th scope="row" colspan="2">Total Marks</th>
<td><b><?php echo htmlentities($totlcount); ?></b> out of <b><?php echo htmlentities($outof=($cnt-1)*100); ?></b></td>
                                                        </tr>
<tr>
                                                <th scope="row" colspan="2">Percntage</th>           
                                                            <td><b><?php echo  htmlentities($totlcount*(100)/$outof); ?> %</b></td>
                                                             </tr>
<tr>
                                                <th scope="row" colspan="2">Download Result</th>           
                                                            <td><b><a href="download-result.php">Download </a> </b></td>
                                                             </tr>

 <?php } else { ?>     
<div class="alert alert-warning left-icon-alert" role="alert">
                                            <strong>Notice!</strong> Your result not declare yet
 <?php }
?>
                                        </div>
 <?php 
 } else
 {?>

<div class="alert alert-danger left-icon-alert" role="alert">
strong>Oh snap!</strong>
<?php
echo htmlentities("Invalid USN");
 }
?>
                                        </div>



                                                	</tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="form-group">
                                                           
                                                            <div class="col-sm-6">
                                                               <a href="index.php">Back to Home</a>
                                                            </div>
                                                        </div>

                                </div>
                                <!-- /.row -->
  
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                  
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    </body>
</html>
       