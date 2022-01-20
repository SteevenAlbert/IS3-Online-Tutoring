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


if(!isset($_GET["code"])){
    exit("can't find this page");
}

$code=$_GET["code"];

$emailQuery="SELECT email FROM resetpassword WHERE code='$code'";
$result = $conn->query($emailQuery);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

if(mysqli_num_rows($result)==0){
    exit("Opps....Something went wrong");
} 

if(isset($_POST["password1"])){
    $pass=$_POST["password1"];
    $row=mysqli_fetch_array($result);
    $email=$row["email"];

    $updateQuery="UPDATE users SET Password='$pass' WHERE email='$email'";
    $result_update = $conn->query($updateQuery);
    if (!$result_update){
        throw new Exception($updateQuery); 
    }
                    

    if($updateQuery){
        $deleteQuery="DELETE FROM resetpassword WHERE code='$code'";
        $result_delete = $conn->query($deleteQuery);
        if (!$result_delete){
            throw new Exception($deleteQuery); 
        }

      exit("Password Updated");
    
    }
    else{
        exit("Something went wrong");
    }
}
?>


<div class = 'page-content'>

<div class = "container">

<form method="post" action="">
<input type="password"  class='input-field form-control' name="password1" id="password1" placeholder="password" required><br>
<input type="password"  class='input-field form-control' name="password2" id="password2" placeholder="confirm password" required><br>
<span id='message'></span>
<br><br>
<input type="submit" id="submit1" value="Done">

</form>
</div>
</div>
<script>
$('#password1, #password2').on('keyup', function () {
  if ($('#password1').val() == $('#password2').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
</script>
