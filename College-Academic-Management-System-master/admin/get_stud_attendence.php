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
  <p> <?php echo htmlentities($result->StudentName); ?><input type="text"  name="ca[]" value="" class="form-control" required="" placeholder="Enter No of Class Attended" autocomplete="off"></p>
  
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

 $query = $dbh->prepare("SELECT sum(distinct(total_classes_taken)) as tc,MAX(PostingDate) as ud from tblattendence where (SubjectID,branchid) in(select distinct SubjectId,branchid from tblattendence where SubjectId='$id1' and branchid='$id') and year='$id2' ");
//$query= $dbh -> prepare($sql);
$query-> bindParam(':id2', $id2, PDO::PARAM_STR);
$query-> bindParam(':id1', $id1, PDO::PARAM_STR);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{ 
foreach($results as $result)
{   ?>

<p><span>Total Classes:</span>
<?php
 echo htmlentities($result->tc); 
 ?></p>


<p><span>Last Added Date:</span>
<?php
 echo htmlentities($result->ud); 
 ?></p>
<?php }

}
  }?>


