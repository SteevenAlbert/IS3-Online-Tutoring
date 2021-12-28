<?php
session_start();
include_once "is3library.php";
establishConnection();

$userName = $_POST['UserName'];
$password = $_POST['Password'];

//-------------------------------------------- Get user data --------------------------------------------
$getUserQuery = "SELECT * FROM users WHERE Username ='$userName' AND Password='$password'";
if(!$conn->query($getUserQuery))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

$result = $conn->query($getUserQuery);
$userData = mysqli_fetch_array($result);



if($userData){
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
    $getPPQuery = "SELECT * FROM learners WHERE UserID ='".$_SESSION['UserID']."'";
    if(!$conn->query($getPPQuery))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    
    $result2 = $conn->query($getPPQuery);
    $row = mysqli_fetch_array($result2);
    $_SESSION['PP']=$row[1];


    header("Location: Home.php");
}else{
    echo "Invalid Login credentials";
}



?>