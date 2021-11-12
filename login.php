<?php

$userName = $_POST['UserName'];
$password = $_POST['Password'];



$conn = new mysqli("localhost","root","","is3 online tutoring");
if($conn->connect_error)
    die("Fatal Error - cannot connect to the Database");

$getUserQuery = "SELECT * FROM users WHERE Username ='$userName'";
if(!$conn->query($getUserQuery))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

$result = $conn->query($getUserQuery);
$userData = mysqli_fetch_array($result);

if($userData[0]==$userName && $userData[1]==$password){
    echo "Welcome Back!";
    echo "<br>"; echo "<br>";
    echo "<a href=ViewCourses.php>View All Courses</a>";
    echo "<br>"; 
    echo "View Enrolled Courses";
    echo "<br>";    echo "<br>";
    echo "<a href=Index.html>Logout</a>";
}else
{
    echo "Invalid User Name or Password"; 
    echo "<br>";
    echo "<a href=Index.html>Try Again</a>";
}
?>