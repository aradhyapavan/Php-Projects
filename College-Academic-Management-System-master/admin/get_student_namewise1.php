<?php
include('includes/config.php');
if(!empty($_POST["Branchid"])) 
{
 $cid=intval($_POST['Branchid']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("invalid Branch");exit;
 }
 else{
 $stmt = $dbh->prepare("SELECT StudentName,StudentId FROM tblstudents WHERE BranchId= :id order by StudentName");
 $stmt->execute(array(':id' => $cid));
 ?><option value="">Select Student </option><?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
  <option value="<?php echo htmlentities($row['StudentId']); ?>"><?php echo htmlentities($row['StudentName']); ?></option>
  <?php
 }
}

}

if(!empty($_POST["Branchid1"])) 
{
 $cid1=intval($_POST['Branchid1']);
 if(!is_numeric($cid1)){
 
  echo htmlentities("invalid Details");exit;
 }
 else{
 $status=0;	
 $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.BranchId=:cid and tblsubjectcombination.status!=:stts order by tblsubjects.SubjectName");
 $stmt->execute(array(':cid' => $cid1,':stts' => $status));
 
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {?>
  <p> <?php echo htmlentities($row['SubjectName']); ?><input type="text"  name="marks[]" value="" class="form-control" required="" placeholder="Enter marks out of 20" autocomplete="off"></p>
  
<?php  }
}
}


?>

<?php

if(!empty($_POST["studclass"])) 
{
 $id= $_POST['studclass'];
 $dta=explode("$",$id);
$id=$dta[0];
$id1=$dta[1];
$id2=$dta[2];
 $query = $dbh->prepare("SELECT StudentId,branchid FROM tbliaresult WHERE  iatype=:id2 and StudentId=:id1 and branchid=:id  ");
//$query= $dbh -> prepare($sql);
$query-> bindParam(':id2', $id2, PDO::PARAM_STR);
$query-> bindParam(':id1', $id1, PDO::PARAM_STR);
$query-> bindParam(':id', $id, PDO::PARAM_STR);

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


