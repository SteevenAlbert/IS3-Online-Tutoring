<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/resetPassword.css">

<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
establishConnection();



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '/xampp/htdocs/IS3-Online-Tutoring/lib/PHPMailer/src/Exception.php';
include '/xampp/htdocs/IS3-Online-Tutoring/lib/PHPMailer/src/PHPMailer.php';
include '/xampp/htdocs/IS3-Online-Tutoring/lib/PHPMailer/src/SMTP.php';

if(isset($_POST["email"])){

    $emailTO=$_POST["email"];
    $code=uniqid(true);
    $query="INSERT INTO resetpassword (code,email) VALUES ('$code','$emailTO')";
    try{
      if (!$result){
          throw new Exception("Error Occured"); 
      }
                  
  }catch(Exception $e){  
     echo"Message:", $e->getMessage();  
  }

    //Create an instance; passing `true` enables exceptions
 $mail = new PHPMailer(true);

 try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'reemh9623@gmail.com';                     //SMTP username
    $mail->Password   = 'forexamplemyemail';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('reemh9623@gmail.com', 'Courses');
    $mail->addAddress("$emailTO");     //Add a recipient
    $mail->addReplyTo('no-reply@gmail.com', 'Information');


    //Content
    $url="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?code=$code";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your password reset link';
    $mail->Body    = "<h1>You requested a password reset</h1>
                       Click <a href='$url'?> this link to do so</a>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "<div class='alert alert-success'>";
    echo "<strong>Success!</strong>Message has been sent";
    echo "</div>";
 } catch (Exception $e) {

    echo "<div class='alert alert-danger'>";
    echo "<strong>Message could not be sent.</strong> Mailer Error: {$mail->ErrorInfo}";
    echo "</div>";
 }

 exit();
}


?>

<div class = 'page-content'>

<div class = "container">
<label> Enter your email to reset password: </label>
<form class = "form-inline" method="post" action="">
<input type="text"  class='input-field form-control' name=email placeholder="Email" autocomplete="off">

<input type="submit" name="submit" value="Reset email">

</form>
</div>
</div>