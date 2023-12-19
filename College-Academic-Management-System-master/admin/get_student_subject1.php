<?php
include('includes/config.php');
error_reporting(0);
if(!empty($_POST["Branchid1"])) 
{
 $cid1=intval($_POST['Branchid1']);
 if(!is_numeric($cid1)){
 
 	echo htmlentities("invalid Class");exit;
 }
 else{
 $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.BranchId=:cid  order by tblsubjects.SubjectName");
 $stmt->execute(array(':cid' => $cid1));
 ?><option value="">Select Subjects </option><?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
  <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['SubjectName']); ?></option>
  <?php
 }
}

}





if(!empty($_POST["studclass"])) 
{
 $id= $_POST['studclass'];
 $dta=explode("$",$id);
$id=$dta[0];
$id1=$dta[1];
 $query = $dbh->prepare("SELECT StudentName,StudentId FROM tblstudents WHERE BranchId= :id and year=:id1 order by StudentName ");
//$query= $dbh -> prepare($sql);
$query-> bindParam(':id1', $id1, PDO::PARAM_STR);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
  <p> <?php echo htmlentities($result->StudentName); ?><input type="text"  name="marks[]" value="" class="form-control" required="" placeholder="Enter marks out of 20" autocomplete="off"></p>
  
<?php  }
}
}
?>

<?php

if(isSet($_POST["dataTosend"])) 
{
$bid=$_POST['bid'];

$stid=$_POST['stid'];
$iatype=$_POST['iatype'];

 $query = $dbh->prepare("SELECT SubjectId,BranchId FROM tbliaresult WHERE  iatype=:id2 and SubjectId=:id1 and BranchId=:id  ");
//$query= $dbh -> prepare($sql);
$query-> bindParam(':id2', $iatype, PDO::PARAM_STR);
$query-> bindParam(':id1', $stid, PDO::PARAM_STR);
$query-> bindParam(':id', $bid, PDO::PARAM_STR);


$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{ ?>
<p>
<?php
echo "<span style='color:red'> Result Already Declare .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
 ?></p>
<?php }


  }?>


