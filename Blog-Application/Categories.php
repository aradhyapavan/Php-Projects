<?php 
error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
  $Category = $_POST["CategoryTitle"];
  $Admin = $_SESSION["UserName"];
  date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($Category)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Categories.php");
  }elseif (strlen($Category)<3) {
    $_SESSION["ErrorMessage"]= "Category title should be greater than 2 characters";
    Redirect_to("Categories.php");
  }elseif (strlen($Category)>49) {
    $_SESSION["ErrorMessage"]= "Category title should be less than than 50 characters";
    Redirect_to("Categories.php");
  }else{
    // Query to insert category in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO category(title,author,datetime)";
    $sql .= "VALUES(:categoryName,:adminName,:dateTime)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':dateTime',$DateTime);
    $Execute=$stmt->execute();

    if($Execute){
      $_SESSION["SuccessMessage"]="Category with id : " .$ConnectingDB->lastInsertId()." added Successfully";
      Redirect_to("Categories.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("Categories.php");
    }
  }
} 
 ?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <title>Categories</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
      <link rel="stylesheet" href="datatables/d/datatables.css">

      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

      <link href="https://unpkg.com/@primer/css/dist/primer.css" rel="stylesheet" />
   </head>
   <style>
      .h-divider {
      margin-top: 5px;
      margin-bottom: 5px;
      height: 1px;
      width: auto;
      border-top: 2px dashed white;
      }
      .sidebar hr.sidebar-divider {
      margin: 0 1rem 1rem;
      }
      .sidebar-light hr.sidebar-divider {
      border-top: 1px solid #eaecf4;
      }
      .sidebar-dark hr.sidebar-divider {
      border-top: 1px solid rgba(255, 255, 255, 0.15);
      }
      .sidebar-dark .sidebar-heading {
      color: rgba(255, 255, 255, 0.4);
      }
   </style>
   </style>
   <body id="page-top">
      <div id="wrapper">
      <?php include('include/nav.php');?>
      <div class="d-flex flex-column" id="content-wrapper">
         <div id="content" style="background-color:black;">
            <?php include('include/top_nav.php');?>
            <nav class="text-white" style="--bs-breadcrumb-divider: '>'; background-color: black;" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            <div class="container-fluid" style="background-color: black;">
               <div class="d-sm-flex justify-content-between align-items-center mt-n1 mb-1 text-white">
                  <h1><i class="fas fa-cut" style="color:white;"></i> Categories Page</h1>
               </div>
         
               <?php include('include/buttons.php');?>
               <div class="container mt-3">
                  <div class="col-md-12">
                     <div class="row justify-content-center">
                     <div class="col-lg-12" style="min-height:300px;">
                     <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="Categories.php" method="post">
        <div class="card  text-white ">
          <div class="card-header" style="background-color:black;">
            <h1>Add New Category</h1>
          </div>
          <div class="card-body text-white" style="background-color:black;">
           
            <div class="col-lg-12 mb-2">
              <label for="title"> <span class="FieldInfo"> Categroy Title: </span></label>
               <input class="form-control my-2 p-3" type="text" name="CategoryTitle" id="title" placeholder="Type title here" value="">
            </div>
           
            
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-outline btn-block"><i class="fas fa-arrow-left  mr-5"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-primary btn-block">
                  <i class="fas fa-check mr-5"></i> Publish
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>
                 
                     
                        <div class="card mb-3 mt-n5 bg-light" >
                                <div class="card-header text-white" style="background-color:black">
                                <i class="fas fa-cut"></i><h2>Existing Categories</h2></div>
                                <div class="card-body bg-light">
                               
                                    <div class="table-responsive table-light">
                                        <table class="table  table-borderless py-2 table-light text-center" style="color: black;" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th> Category Name</th>
            <th>Creator Name</th>
            <th>Action</th>
          </tr>                       </thead>
                                            <tfoot>
                                            <tr>
            <th>No. </th>
            <th>Date&Time</th>
            <th> Category Name</th>
            <th>Creator Name</th>
            <th>Action</th>
          </tr>                         </tfoot>
                                            <tbody>
                                            <?php
      global $ConnectingDB;
      $sql = "SELECT * FROM category ORDER BY id desc";
      $Execute =$ConnectingDB->query($sql);
      $SrNo = 0;
      while ($DataRows=$Execute->fetch()) {
        $CategoryId = $DataRows["id"];
        $CategoryDate = $DataRows["datetime"];
        $CategoryName = $DataRows["title"];
        $CreatorName= $DataRows["author"];
        $SrNo++;
      ?>
      
            
      <tr>
          <td><?php echo htmlentities($SrNo); ?></td>
          <td><?php echo htmlentities($CategoryDate); ?></td>
          <td><?php echo htmlentities($CategoryName); ?></td>
          <td><?php echo htmlentities($CreatorName); ?></td>
          <td> <a href="DeleteCategory.php?id=<?php echo $CategoryId;?>" class="btn btn-danger">Delete</a>  </td>

      </tbody>
      <?php } ?>
       
 </table>
                                    </div> </div>
                                
                            </div>
                     </div>
                  </div>
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
      
    <script src="datatables/datatables-demo.js"></script>
    <script src="datatables/dataTables.bootstrap4.min.js"></script>


    <script src=" https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="datatables/d/datatables.min.js">
   
   </body>
</html>