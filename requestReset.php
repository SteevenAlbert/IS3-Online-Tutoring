<?php

include_once "is3library.php";
establishConnection();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST["email"])){

    $emailTO=$_POST["email"];
    $code=uniqid(true);
    $query="INSERT INTO resetpassword (code,email) VALUES ('$code','$emailTO')";
    $result = $conn->query($query);
    if (!$result)
      die ("Query error. $query");

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
    echo 'Message has been sent';
 } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }

 exit();
}


?>
<form method="post" action="">
<input type="text" name=email placeholder="Email" autocomplete="off">
<br>
<input type="submit" name="submit" value="Reset email">

</form>