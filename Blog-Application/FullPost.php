<?php 

error_reporting(0);
include("include/db.php"); 
 include("include/required.php"); 
include("include/Sessions.php"); 
 $SearchQueryParameter = $_GET["id"]; 

if(isset($_POST["Submit"])){
  $Name    = $_POST["CommenterName"];
  $Email   = $_POST["CommenterEmail"];
  $Comment = $_POST["CommenterThoughts"];
  date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($Name)||empty($Email)||empty($Comment)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }elseif (strlen($Comment)>500) {
    $_SESSION["ErrorMessage"]= "Comment length should be less than 500 characters";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }else{
    // Query to insert comment in DB When everything is fine
    global $ConnectingDB;
    $sql  = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
    $sql .= "VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postIdFromURL)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt -> bindValue(':dateTime',$DateTime);
    $stmt -> bindValue(':name',$Name);
    $stmt -> bindValue(':email',$Email);
    $stmt -> bindValue(':comment',$Comment);
    $stmt -> bindValue(':postIdFromURL',$SearchQueryParameter);
    $Execute = $stmt -> execute();
    //var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMessage"]="Comment Submitted Successfully";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }else {
      $_SESSION["ErrorMessage"]="Something went wrong. Try Again !";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }
  }
} 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <link href="https://unpkg.com/@primer/css/dist/primer.css" rel="stylesheet" />
  <style media="screen">
  .heading{
      font-family: Bitter,Georgia,"Times New Roman",Times,serif;
      font-weight: bold;
       color: #005E90;
  }
  .heading:hover{
    color: #0090DB;
  }
  </style>
  <title>Full Post Page</title>

</head>
<body>
  
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"> Sughosh Suggi</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Home</a>
        </li>
        
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
          <input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
          <button  class="btn btn-primary" name="SearchButton">Go</button>
          </div>
        </form>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    
    <div class="container">
      <div class="row mt-4">
        <!-- Main Area Start-->
        <div class="col-sm-8 ">
          <h1>Blogs And Stories </h1>
          <h1 class="lead"> by Sughosh Suggi</h1>
          <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <?php
          global $ConnectingDB;
        
          if(isset($_GET["SearchButton"])){
            $Search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();
          }
          // The default SQL query
          else{
            $PostIdFromURL = $_GET["id"];
            if (!isset($PostIdFromURL)) {
              $_SESSION["ErrorMessage"]="Bad Request !";
              Redirect_to("Blog.php?page=1");
            }
            $sql  = "SELECT * FROM posts  WHERE id= '$PostIdFromURL'";
            $stmt =$ConnectingDB->query($sql);
            $Result=$stmt->rowcount();
            if ($Result!=1) {
              $_SESSION["ErrorMessage"]="Bad Request !";
              Redirect_to("Blog.php?page=1");
            }

          }
          while ($DataRows = $stmt->fetch()) {
            $PostId          = $DataRows["id"];
            $DateTime        = $DataRows["datetime"];
            $PostTitle       = $DataRows["title"];
            $Category        = $DataRows["category"];
            $Admin           = $DataRows["author"];
            $Image           = $DataRows["image"];
            $PostDescription = $DataRows["post"];
          ?>
          <div class="card">
            <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" />
            <div class="card-body">
              <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
              <small class="text-muted">Category: <span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime); ?></span></small>
            <hr>
              <p class="card-text">
                <?php echo nl2br($PostDescription); ?></p>
            </div>
          </div>
          <br>
          <?php   } ?>
          <!-- Comment Part Start -->
          <!-- Fetching existing comment START  -->
          <span class="FieldInfo">Comments</span>
          <br><br>
        <?php
        global $ConnectingDB;
        $sql  = "SELECT * FROM comments
         WHERE post_id='$SearchQueryParameter' AND status='ON'";
        $stmt =$ConnectingDB->query($sql);
        while ($DataRows = $stmt->fetch()) {
          $CommentDate   = $DataRows['datetime'];
          $CommenterName = $DataRows['name'];
          $CommentContent= $DataRows['comment'];
        ?>
  <div>
    <div class="media CommentBlock">
      <img class="d-block img-fluid align-self-start" src="images/comment.png" alt="">
      <div class="media-body ml-2">
        <h6 class="lead"><?php echo $CommenterName; ?></h6>
        <p class="small"><?php echo $CommentDate; ?></p>
        <p><?php echo $CommentContent; ?></p>
      </div>
    </div>
  </div>
  <hr>
  <?php } ?>

        <!--  Fetching existing comment END -->

          <div>
            <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="FieldInfo">Share your thoughts about this post</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterEmail" placeholder="Email" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea name="CommenterThoughts" class="form-control" rows="6" cols="80"></textarea>
                  </div>
                  <div class="">
                    <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
            <!-- Comment Part End -->
        </div>
        <!-- Main Area End-->

        <!-- Side Area Start -->
        <div class="col-sm-4">
          <div class="card mt-4">
            <div class="card-body">
              <img src="images/startblog.png" class="d-block img-fluid mb-3" alt="">
              <div class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-dark text-light">
              <h2 class="lead">Sign Up !</h2>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</button>
              <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="" placeholder="Enter your email"value="">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-primary text-light">
              <h2 class="lead">Categories</h2>
              </div>
              <div class="card-body">
                <?php
                global $ConnectingDB;
                $sql = "SELECT * FROM category ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);
                while ($DataRows = $stmt->fetch()) {
                  $CategoryId = $DataRows["id"];
                  $CategoryName=$DataRows["title"];
                 ?>
                <a href="Blog.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
               <?php } ?>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-info text-white">
              <h2 class="lead"> Recent Posts</h2>
            </div>
            <div class="card-body">
              <?php
              global $ConnectingDB;
              $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt= $ConnectingDB->query($sql);
              while ($DataRows=$stmt->fetch()) {
                $Id     = $DataRows['id'];
                $Title  = $DataRows['title'];
                $DateTime = $DataRows['datetime'];
                $Image = $DataRows['image'];
              ?>
              <div class="media">
                <img src="Uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;" href="FullPost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                  <p class="small"><?php echo htmlentities($DateTime); ?></p>
                </div>
              </div>
              <hr>
              <?php } ?>
            </div>
          </div>

        </div>
        <!-- Side Area End -->
      </div>

    </div>

 
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Ardent Connect <span id="year"></span> &copy; ----All right Reserved.</p>
           </div>
         </div>
      </div>
    </footer>
        <div style="height:10px; background:#27aae1;"></div>
    <!-- FOOTER END-->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
  $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
<?php //include("footer.php");?> 
