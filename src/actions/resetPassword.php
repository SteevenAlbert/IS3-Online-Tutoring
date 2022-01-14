<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
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
    exit("No row");
} 

if(isset($_POST["password1"])){
    $pass=$_POST["password1"];
    $row=mysqli_fetch_array($result);
    $email=$row["email"];

    $updateQuery="UPDATE users SET Password='$pass' WHERE email='$email'";
    $result_update = $conn->query($updateQuery);
    try{
        if (!$result_update){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }

    if($updateQuery){
        $deleteQuery="DELETE FROM resetpassword WHERE code='$code'";
        $result_delete = $conn->query($deleteQuery);
        try{
            if (!$result_delete){
                throw new Exception("Error Occured"); 
            }
                        
        }catch(Exception $e){  
           echo"Message:", $e->getMessage();  
        }

      exit("Password Updated");
    
    }
    else{
        exit("Something went wrong");
    }
}
?>

    <form method="post" action="">
<input type="password" name=password1 placeholder="password" autocomplete="off"><br>
<input type="password" name=password2 placeholder="confirm password" autocomplete="off"><br>
<input type="submit" name="submit1" value="Done">

</form>