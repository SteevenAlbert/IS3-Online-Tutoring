<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$user = $_SESSION['UserID'];
$course = $_GET['id'];

// check wether the course is already in the cart
$message1="Course already in cart";
$checkInCart= "SELECT CourseID FROM cartcourses WHERE UserID='".$user."' AND CourseID=".$course;
$result_checkCart = mysqli_query($conn,$checkInCart);

if(!$result_checkCart){
    die ("Error. $checkInCart");
}

$row1 = mysqli_num_rows($result_checkCart);
if($row1!=0){
    echo "<script>alert('$message1');</script>";
}


//check wether the learner already enrolled in this course
$message2="You are already enrolled in this course";
$checkInEnroll= "SELECT CourseID FROM enroll WHERE UserID='$user' AND CourseID=".$course;
$result_checkEnroll = mysqli_query($conn,$checkInEnroll);
if(!$result_checkEnroll){
    die ("Error. $checkInEnroll");
}

$row2 = mysqli_num_rows($result_checkEnroll);
if($row2!=0){
    echo "<script>alert('$message2');</script>";
}
else{
    $insertCartQuery= "INSERT INTO cartcourses (UserID,CourseID) 
    VALUES ('".$user."','".$course."')";

    $result_insertCart = mysqli_query($conn,$insertCartQuery);
    if(!$result_insertCart){
        die ("Error. $insertCartQuery");
    }
    header("Location:/IS3-Online-Tutoring/src/view/viewApprovedCourses.php");
}

?>