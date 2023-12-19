<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{



   $USN = $_POST['USN'];
    $result = mysqli_query($con,"SELECT * FROM student where USN='" . $_POST['USN'] . "'");
    $row = mysqli_fetch_assoc($result);
	$fetch_USN=$row['USN'];
	$email_id=$row['s_email'];
	$password=$row['password'];


require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'bcestudentsportal@gmail.com';
$mail->Password = 'aradhya@123';

$mail->setFrom('bcestudentsportal@gmail.com', 'BCE');
$mail->addAddress($email_id);
			


	if($USN==$fetch_USN) {
		$to = $email_id;
              $mail->Subject = 'verification';
	       $mail->Body ='password is '.htmlspecialchars($password);
                     $email=htmlspecialchars($email_id);



                 
		if ($mail->send()){

                       
			echo '<script>alert("password is Sent")</script>';

			}
				else{
					echo 'invalid userid';

}

echo "<script>window.open('index.php','_self')</script>";				}
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>input-masks</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <div class="registration-form">
        <form method="post" name="sentMessage">
            <div class="form-icon"><span><i class="icon-user icon"></i></span></div>
            <div class="form-group"><input class="form-control item" type="text" name="USN" id="USN" name="USN" id="USN" oninput="this.value = this.value.toUpperCase()" autocomplete="off" maxlength="15" placeholder="USN" ></div>
            
            <div class="form-group"><button class="btn btn-primary btn-block create-account" type="submit" name="login" id="login">Get Your Password</button></div>
                     <a class="btn btn-link center-block" role="button" href="index">Login</a><a class="btn btn-link center-block" role="button" href="register">Register Now</a>
          
        </form>
        
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>