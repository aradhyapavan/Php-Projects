<?php 
error_reporting(0);
include("include/db.php");
 include("include/required.php"); 
 include("include/Sessions.php"); 
Confirm_Login(); 

   $SarchQueryParameter = $_GET['id'];
   if(isset($_POST["Submit"])){
     $PostTitle = $_POST["PostTitle"];
     $Category  = $_POST["Category"];
     $Image     = $_FILES["Image"]["name"];
     $Target    = "Uploads/".basename($_FILES["Image"]["name"]);
     $PostText  = $_POST["PostDescription"];
     $Admin     = "Jazeb";
     date_default_timezone_set("Asia/Calcutta");
     $CurrentTime = time();
     $DateTime    = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
   
     if(empty($PostTitle)){
       $_SESSION["ErrorMessage"]= "Title Cant be empty";
       Redirect_to("Posts.php");
     }elseif (strlen($PostTitle)<5) {
       $_SESSION["ErrorMessage"]= "Post Title should be greater than 5 characters";
       Redirect_to("Posts.php");
     }elseif (strlen($PostText)>9999) {
       $_SESSION["ErrorMessage"]= "Post Description should be less than than 1000 characters";
       Redirect_to("Posts.php");
     }else{
       // Query to Update Post in DB When everything is fine
       global $ConnectingDB;
       if (!empty($_FILES["Image"]["name"])) {
         $sql = "UPDATE posts
                 SET title='$PostTitle', category='$Category', image='$Image', post='$PostText'
                 WHERE id='$SarchQueryParameter'";
       }else {
         $sql = "UPDATE posts
                 SET title='$PostTitle', category='$Category', post='$PostText'
                 WHERE id='$SarchQueryParameter'";
       }
       $Execute= $ConnectingDB->query($sql);
       move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
       //var_dump($Execute);
       if($Execute){
         $_SESSION["SuccessMessage"]="Post Updated Successfully";
         Redirect_to("Posts.php");
       }else {
         $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
         Redirect_to("Posts.php");
       }
     }
   } 
    ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Profile - Brand</title>
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
                     <li class="breadcrumb-item"><a href="Dashboard.php">Admin Dashboard</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><a href="Posts.php"> Posts</a></li>
                     <li class="breadcrumb-item active" aria-current="page"> Edit</li>
                  </ol>
               </nav>
               <div class="container-fluid mb-n4" style="background-color: black;">
                
                  <section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
      
       echo SuccessMessage();
       // Fetching Existing Content according to our
       global $ConnectingDB;
       $sql  = "SELECT * FROM posts WHERE id='$SarchQueryParameter'";
       $stmt = $ConnectingDB ->query($sql);
       while ($DataRows=$stmt->fetch()) {
         $TitleToBeUpdated    = $DataRows['title'];
         $CategoryToBeUpdated = $DataRows['category'];
         $ImageToBeUpdated    = $DataRows['image'];
         $PostToBeUpdated     = $DataRows['post'];
         // code...
       }
       ?>
      <form class="" action="EditPost.php?id=<?php echo $SarchQueryParameter; ?>" method="post" enctype="multipart/form-data">
        <div class="card  mb-3" style="background-color:white;color:black;">
        <div class="card-header text-white" style="background-color:black">
                       
                              <h3>        <i class="fas fa fa-edit  text-primary"></i>Edit Posts</h3>
                           </div>
          <div class="card-body py-3" style="background-color:white;">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
               <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeUpdated; ?>">
            </div>
            <div class="form-group">
              <span class="FieldInfo">Existing Category: </span>
              <?php echo $CategoryToBeUpdated;?>
              <br>
              <label for="CategoryTitle"> <span class="FieldInfo"> Chose Categroy </span></label>
               <select class="form-control" id="CategoryTitle"  name="Category">
                 <?php
                 //Fetchinng all the categories from category table
                 global $ConnectingDB;
                 $sql  = "SELECT id,title FROM category";
                 $stmt = $ConnectingDB->query($sql);
                 while ($DataRows = $stmt->fetch()) {
                   $Id            = $DataRows["id"];
                   $CategoryName  = $DataRows["title"];
                  ?>
                  <option> <?php echo $CategoryName; ?></option>
                  <?php } ?>
               </select>
            </div>
            <div class="form=group mb-1">
              <span class="FieldInfo">Existing Image: </span>
              <img  class="mb-1" src="Uploads/<?php echo $ImageToBeUpdated;?>" width="170px"; height="70px"; >
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select Image </label>
              </div>
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Post: </span></label>
              <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                <?php echo $PostToBeUpdated;?>
              </textarea>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
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
            </div>
            <footer class="sticky-footer mt-2" style="background-color: black;">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright text-white"><span>Designed & Developed By Ardent Connect Team</span></div>
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