<?php
namespace Dompdf;
require_once('dompdf/dompdf/autoload.inc.php');
session_start();
ob_start();
require_once('includes/configpdo.php');
error_reporting(0);
?>

<html>
<style>
body {
  padding: 4px;
  text-align: center;
}

table {
  width: 100%;
  margin: 10px auto;
  table-layout: auto;
}

.fixed {
  table-layout: fixed;
}

table,
td,
th {
  border-collapse: collapse;
}

th,
td {
  padding: 1px;
  border: solid 1px;
  text-align: center;
}


</style>
<?php $USN=$_SESSION['USN'];
$Branchid=$_SESSION['Branchid'];

$iatype=$_SESSION['iatype'];
$qery = "SELECT   tblstudents.StudentName,tblstudents.USN,tblstudents.StudentId,tblclasses.branch_name,tblclasses.sem from tblstudents join tblclasses on tblclasses.id=tblstudents.BranchId where tblstudents.USN=? and tblstudents.BranchId=?";
$stmt21 = $mysqli->prepare($qery);
$stmt21->bind_param("ss",$USN,$Branchid);
$stmt21->execute();
                 $res1=$stmt21->get_result();
                 $cnt=1;
                   while($result=$res1->fetch_object())
                  {  ?>
<p><b> Name :</b> <?php echo htmlentities($result->StudentName);?></p>
<p><b> USN :</b> <?php echo htmlentities($result->USN);?>
<p><b> Branch:</b> <?php echo htmlentities($result->branch_name);?>
<p><b> sem:</b> <?php echo htmlentities($result->sem);?>
<?php }

    ?>
 <table class="table table-inverse" border="1">
                      
                                                <table class="table table-hover table-bordered">
                                                <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Subject</th>    
                                                            <th>Marks</th>
                                                        </tr>
                                               </thead>
  


                                                  
                                                  <tbody>
<?php                                              
// Code for result
 $query ="select t.StudentName,t.USN,t.BranchId,t.marks,t.iatype,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.USN,sts.BranchId,tr.marks,tr.iatype,SubjectId from tblstudents as sts join  tbliaresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.USN=? and t.BranchId=? and t.iatype=?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss",$USN,$Branchid,$iatype);
$stmt->execute();
                 $res=$stmt->get_result();
                 $cnt=1;
                   while($row=$res->fetch_object())
                  {

    ?>

                                                    <tr>
                                                <td ><?php echo htmlentities($cnt);?></td>
                                                      <td><?php echo htmlentities($row->SubjectName);?></td>
                                                      <td><?php echo htmlentities($totalmarks=$row->marks);?></td>
                                                    </tr>
<?php 
$totlcount+=$totalmarks;
$cnt++;}
?>

                            </tbody>
                        </table>
                    </div>
</html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->setPaper('A4', 'portrait');
$dompdf->load_html($html);
$dompdf->render();
//$dompdf->stream("result.php",array("Attachment" => false));
$dompdf->stream("result.pdf");
?>