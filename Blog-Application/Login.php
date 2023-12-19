<?php 


include("include/db.php"); 
 include("include/required.php"); 
 include("include/Sessions.php"); 

if(isset($_SESSION["UserId"])){
  Redirect_to("Dashboard.php");
}

if (isset($_POST["submit"])) {
  $UserName = $_POST["Username"];
  $Password = $_POST["Password"];
  if (empty($UserName)||empty($Password)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Login.php");
  }else {
    // code for checking username and password from Database
    $Found_Account=Login_Attempt($UserName,$Password);
    if ($Found_Account) {
      $_SESSION["UserId"]=$Found_Account["id"];
      $_SESSION["UserName"]=$Found_Account["username"];
      $_SESSION["AdminName"]=$Found_Account["aname"];
      $_SESSION["SuccessMessage"]= "Wellcome ".$_SESSION["AdminName"]."!";
      if (isset($_SESSION["TrackingURL"])) {
        Redirect_to($_SESSION["TrackingURL"]);
      }else{
      Redirect_to("Dashboard.php");
    }
    }else {
      $_SESSION["ErrorMessage"]="Incorrect Username/Password";
      Redirect_to("Login.php");
    }
  }
}

?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="login.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

    <title>Admin Login</title>
</head>

<body>
    <!-- Main Content -->
    <div class="container-fluid mt-5 d-flex justify-content-center" style="align-items:center;">
        <div class="row main-content  bg-success text-center">
            <div class="col-md-4 text-center company__info mb-n2">
                <span class="company__logo"><h2><img class="rounded-circle  mt-n3 mb-n3 xs-mb-3 mb-sm-3" src="ac.png" width="180" height="180"></h2>
                </span>
                <h4 class="company_title"><strong>Ardent Connect</strong></h4><br>
                <p>Envisioning A Brighter Future</p>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <h2>Admin </h2>
                    </div>
                    <div class="row">
                        <form  class="form-group"  method="post">
                           
                            <div class="row">
                                <input type="text" name="Username" id="username" class="form__input" placeholder="User Name" autocomplete="off" required>
                            </div>
                            <div class="row">
                            
                                <input type="password" name="Password" id="password" class="form__input" placeholder="Password" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <span> <input type="checkbox" name="remember_me" id="remember_me" class="">
                                <label for="remember_me">Stay Signed In!</label></span>
                            </div>
                            <div class="row mt-n2 justify-content-center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
<?php ?>