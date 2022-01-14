<?php
session_start();
include_once "is3library.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
establishConnection();

$username = $_POST['username'];
$password = $_POST['password'];

//-------------------------------------------- Get user data --------------------------------------------
$getUserQuery = "SELECT * FROM users WHERE Username ='$username'";
$result = $conn->query($getUserQuery);
try{
    if(!$result){     
        throw new Exception("Error Occured");   
    }
    
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

$userData = mysqli_fetch_array($result);
$hashedPass="";

if($userData){
    $hashedPass = $userData[2];
}
if(password_verify($password, $hashedPass)){
    // Update session 
    $_SESSION['UserID']= $userData[0];
    $_SESSION['username']= $userData[1];
    $_SESSION['password']= $userData[2];
    $_SESSION['FirstName']=$userData[3];
    $_SESSION['LastName']=$userData[4];
    $_SESSION['Email']=$userData[5];
    $_SESSION['PhoneNo']=$userData[6];
    $_SESSION['Country']=$userData[7];
    $_SESSION['BirthDate']=$userData[8];
    $_SESSION['UserType']=$userData[9];
    
    // Get Profile Picture
    if($_SESSION['UserType']=="Tutor"){
        $getPPQuery = "SELECT * FROM tutors WHERE UserID ='".$_SESSION['UserID']."'";
        if(!$conn->query($getPPQuery))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
    }else{
        $getPPQuery = "SELECT * FROM learners WHERE UserID ='".$_SESSION['UserID']."'";
        if(!$conn->query($getPPQuery))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
    }
    $result2 = $conn->query($getPPQuery);

    try{
        if(!$result2){
        throw new Exception("Error Occured");
        }
    }
    catch(Exception $e){
        throw new Exception("Error Occured"); 
    }
    
    
    $row = mysqli_fetch_array($result2);

    if($row){
      $_SESSION['PP']=$row[1];
    }
    
    echo "success";
}else{
    echo "Invalid Login credentials";
}



?>