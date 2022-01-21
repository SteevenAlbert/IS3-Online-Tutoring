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
if(!$result){     
    throw new Exception($getUserQuery);   
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
    $_SESSION['PP']="default.png";
    // Get Profile Picture
    if($_SESSION['UserType']=="Tutor"){
        $getPPQuery = "SELECT * FROM tutors WHERE UserID ='".$_SESSION['UserID']."'";
    }else{
        $getPPQuery = "SELECT * FROM learners WHERE UserID ='".$_SESSION['UserID']."'";
    }
    $result2 = $conn->query($getPPQuery);

    if(!$result2){
        throw new Exception($getPPQuery);
    }
    
    
    $row = mysqli_fetch_array($result2);

    if($row){
      $_SESSION['PP']=$row[1];
    }

    if($_SESSION['PP']==""){
        $_SESSION['PP']="default.png";
    }
    
    echo "success";
}else{
    echo "Invalid credentials";
}



?>