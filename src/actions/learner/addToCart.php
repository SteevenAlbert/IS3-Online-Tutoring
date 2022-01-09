<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$insertCartQuery= "INSERT INTO cartcourses (UserID,CourseID) 
    VALUES ('".$_SESSION['UserID']."','".$_GET['id']."')";

$result_insertCart = mysqli_query($conn,$insertCartQuery);
if(!$result_insertCart){
    die ("Error. $insertCartQuery");
}

header("Location:/IS3-Online-Tutoring/src/view/viewApprovedCourses.php");

?>