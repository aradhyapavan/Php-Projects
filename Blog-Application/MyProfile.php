<?php
error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 
 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();


$AdminId = $_SESSION["UserId"];
global $ConnectingDB;
$sql  = "SELECT * FROM admins WHERE id='$AdminId'";
$stmt =$ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $ExistingName     = $DataRows['aname'];
  $ExistingUsername = $DataRows['username'];
  $ExistingHeadline = $DataRows['aheadline'];
  $ExistingBio      = $DataRows['abio'];
  $ExistingImage    = $DataRows['aimage'];
}

if(isset($_POST["Submit"])){
  $AName     = $_POST["Name"];
  $AHeadline = $_POST["Headline"];
  $ABio      = $_POST["Bio"];
  $Image     = $_FILES["Image"]["name"];
  $Target    = "Images/".basename($_FILES["Image"]["name"]);
if (strlen($AHeadline)>30) {
    $_SESSION["ErrorMessage"] = "Headline Should be less than 30 characters";
    Redirect_to("MyProfile.php");
  }elseif (strlen($ABio)>500) {
    $_SESSION["ErrorMessage"] = "Bio should be less than than 500 characters";
    Redirect_to("MyProfile.php");
  }else{
   
    global $ConnectingDB;
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE admins
              SET aname='$AName', aheadline='$AHeadline', abio='$ABio', aimage='$Image'
              WHERE id='$AdminId'";
    }else {
      $sql = "UPDATE admins
              SET aname='$AName', aheadline='$AHeadline', abio='$ABio'
              WHERE id='$AdminId'";
    }
    $Execute= $ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
      $_SESSION["SuccessMessage"]="Details Updated Successfully";
      Redirect_to("MyProfile.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("MyProfile.php");
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
   
</head>

<body id="page-top">
    <div id="wrapper">
    <?php include('include/nav.php');?>
        <div class="d-flex flex-column" id="content-wrapper" style="background-color: black;">
            <div id="content">
            <?php include('include/top_nav.php');?>     
                <nav class="text-white" style="--bs-breadcrumb-divider: '>'; background-color: black;" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile Edit</li>
                    </ol>
                </nav>
                <div class="container-fluid mb-n4" style="background-color: black;">
                    <h3 class="text-dark mt-n2">
                        <p class="mt-2 text-white">Profile</p>
                    </h3>
                    <div class="row ">
                        <div class="col-lg-3">
                            <div class="card mb-3">
                                <div class="card-header py-3" style="background-color:black;color:white">
                                    <p class=" m-0 font-weight-bold text-primary"><h3> <?php echo $ExistingName; ?></h3></p>
                                </div>
                                <div class="card-body text-center shadow"><img class="rounded-circle md-mt-3 md-mt-3" src="images/<?php echo $ExistingImage; ?>" width="165" height="165">
                                    <div class="mb-3 mt-4"><label for="email"><strong style="color: black;">Bio</strong></label>
                                    <p><?php echo $ExistingBio; ?> </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-9">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow ">
                                        <div class="card-header py-3" style="background-color:black;">
                                            <p class="text-primary m-0 font-weight-bold" >Edit Profile Info</p>
                                        </div>
                                        <div class="card-body">
                                        <?php
     
       echo SuccessMessage();
       ?>
      <form class="" action="MyProfile.php" method="post" enctype="multipart/form-data">
     

          <div class="card-body ">
            <div class="form-group">
               <input class="form-control" type="text" name="Name" id="title" placeholder="Your name" value="">
            </div>
            <div class="form-group">
               <input class="form-control" type="text" id="title" placeholder="Headline" name="Headline">
               <small class="text-muted"> Add a professional headline like, 'Engineer' at XYZ or 'Architect' </small>
               <span class="text-danger">Not more than 30 characters</span>
            </div>
            <div class="form-group">
              <textarea  placeholder="Bio" class="form-control" id="Post" name="Bio" rows="8" cols="80"></textarea>
            </div>

            <div class="form-group">
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select Image </label>
              </div>
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
       
      </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <footer class="sticky-footer  text-white " style="background-color: black;">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Designed & Developed By Ardent Connect Team</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>