<?php
session_start();
if($_SESSION['UserType']=="Learner"){
    echo "Welcome Back, ".$_SESSION['FirstName']."!";
    echo "<br>"; echo "<br>";
    echo "<a href=ViewCourses.php>View All Courses</a>";
    echo "<br>"; 
    echo "View Enrolled Courses";
    echo "<br>"; 
    echo "Edit Profile";
    echo "<br>";    echo "<br>";
    echo "<a href=logout.php>Logout</a>";
}else if($_SESSION['UserType']=="Tutor")
{ 
    "Welcome Back, ".$_SESSION['FirstName']."!";
    echo "<br>"; echo "<br>";
    echo "<a href=ViewCourses.php>View All Courses</a>";
    echo "<br>"; 
    echo "<a href=addCourse.php>Add Course</a>";
    echo "<br>";
    echo "View Enrolled Courses";
    echo "<br>";
    echo "Edit Profile";
    echo "<br>";    echo "<br>";
    echo "<a href=logout.php>Logout</a>";
}

?>