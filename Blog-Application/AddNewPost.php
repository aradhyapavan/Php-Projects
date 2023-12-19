<?php 
error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 
 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
   Confirm_Login(); ?>
<?php
   if(isset($_POST["Submit"])){
     $PostTitle = $_POST["PostTitle"];
     $Category  = $_POST["Category"];
     $Image     = $_FILES["Image"]["name"];
     $Target    = "Uploads/".basename($_FILES["Image"]["name"]);
     $PostText  = $_POST["PostDescription"];
     $Admin = $_SESSION["UserName"];
     date_default_timezone_set("Asia/Culcutta");
     $CurrentTime=time();
     $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
   
     if(empty($PostTitle)){
       $_SESSION["ErrorMessage"]= "Title Cant be empty";
       Redirect_to("AddNewPost.php");
     }elseif (strlen($PostTitle)<5) {
       $_SESSION["ErrorMessage"]= "Post Title should be greater than 5 characters";
       Redirect_to("AddNewPost.php");
     }elseif (strlen($PostText)>9999) {
       $_SESSION["ErrorMessage"]= "Post Description should be less than than 1000 characters";
       Redirect_to("AddNewPost.php");
     }else{
       
       global $ConnectingDB;
       $sql = "INSERT INTO posts(datetime,title,category,author,image,post)";
       $sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
       $stmt = $ConnectingDB->prepare($sql);
       $stmt->bindValue(':dateTime',$DateTime);
       $stmt->bindValue(':postTitle',$PostTitle);
       $stmt->bindValue(':categoryName',$Category);
       $stmt->bindValue(':adminName',$Admin);
       $stmt->bindValue(':imageName',$Image);
       $stmt->bindValue(':postDescription',$PostText);
       $Execute=$stmt->execute();
       move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
       if($Execute){
         $_SESSION["SuccessMessage"]="Post with id : " .$ConnectingDB->lastInsertId()." added Successfully";
         Redirect_to("AddNewPost.php");
       }else {
         $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
         Redirect_to("AddNewPost.php");
       }
     }
   } 
    ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Add New Post</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
      <link href="https://unpkg.com/@primer/css/dist/primer.css" rel="stylesheet" />
  
   </head>
   <body id="page-top">
      <div id="wrapper">
         <?php include('include/nav.php');?>
         <div class="d-flex flex-column" id="content-wrapper" style="background-color: black;">
            <div id="content">
               <?php include('include/top_nav.php');?>     
               <nav class="text-white" style="--bs-breadcrumb-divider: '>'; background-color: black;" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="dashboard.php">Student Portal</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Personal Info</li>
                  </ol>
               </nav>
               <div class="container-fluid mb-n4" style="background-color: black;">
               
                  <div class="row ">
                  <section class="container py-2 mb-4">
  <div class="row">
  <section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
        <div class="card  text-dark mb-3" >
        <div class="card-header text-light" style="background-color:black">
            <h1>Add New Posts</h1>
          </div>
          <div class="card-body bg-light">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
               <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="">
            </div>
            <div class="form-group">
              <label for="CategoryTitle"> <span class="FieldInfo"> Chose Categroy </span></label>
               <select class="form-control" id="CategoryTitle"  name="Category">
                 <?php
               
                 global $ConnectingDB;
                 $sql = "SELECT id,title FROM category";
                 $stmt = $ConnectingDB->query($sql);
                 while ($DataRows = $stmt->fetch()) {
                   $Id = $DataRows["id"];
                   $CategoryName = $DataRows["title"];
                  ?>
                  <option> <?php echo $CategoryName; ?></option>
                  <?php } ?>
               </select>
            </div>
              <div class="custom-file">
              <label for="imageSelect" class="custom-file-label">Select Image </label>
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              
              </div>
        
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Post: </span></label>
              <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-outline btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-primary btn-block">
                  <i class="fas fa-check"></i> Publish
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>

  </div>

</section>
                  </div>
               </div>
            </div>
            <footer class="sticky-footer mt-2" style="background-color: black;">
               <div class="container my-auto">
                  <div class="text-center my-auto copyright"><span>Designed & Developed By Ardent Connect Team</span></div>
               </div>
            </footer>
         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
      <script src="assets/js/script.min.js"></script>

   </body>
</html>