<?php
session_start();
include_once "is3library.php";
establishConnection();

$userName = $_POST['UserName'];
$password = $_POST['Password'];


$getUserQuery = "SELECT * FROM users WHERE Username ='$userName' AND Password='$password'";
if(!$conn->query($getUserQuery))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

$result = $conn->query($getUserQuery);
$userData = mysqli_fetch_array($result);

if($userData){
    $_SESSION['username']= $userData[0];
    $_SESSION['password']= $userData[1];
    $_SESSION['FirstName']=$userData[2];
    $_SESSION['LastName']=$userData[3];
    $_SESSION['Email']=$userData[4];
    $_SESSION['PhoneNo']=$userData[5];
    $_SESSION['Country']=$userData[6];
    $_SESSION['BirthDate']=$userData[7];
    $_SESSION['UserType']=$userData[8];
    $_SESSION['PP']=$userData[9];
    header("Location: Home.php");
}



?>