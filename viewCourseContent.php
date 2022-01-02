<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user=$_SESSION['UserID'];
$id = $_GET['id'];
$query = "SELECT * FROM enroll WHERE UserID ='$user' AND CourseID='$id'";
$result = $conn->query($query);
if (!$result)
    die(mysqli_errno($conn).": " .mysqli_error($conn));
$enrolled = mysqli_fetch_array($result);

if($enrolled){
    $getCoursesQuery = "SELECT * FROM courses WHERE CourseID=".$_GET["id"];
    $result = $conn->query($getCoursesQuery);
    if (!$result)
        die ("Query error. $getCoursesQuery");

    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo "<h1>".$row["Code"]." - ".$row["Title"]."</h1>" ;
    echo "Level: <b>".$row["Level"]."</b>"."&nbsp&nbsp&nbsp&nbsp&nbsp Hours: <b>".$row["Hours"]."</b>";
    echo "<p>".$row["Description"]."</p><br>"; 

    echo "<h3>Chapters </h3>";
    $courseID=$_GET['id'];
    $query = "SELECT * FROM coursechapters WHERE courseID=".$_GET['id'];
    if(!$conn->query($query))
        echo mysqli_errno($conn).": " .mysqli_error($conn);

    $result = $conn->query($query);
    while($row =$result->fetch_array(MYSQLI_ASSOC)){
        $title= $row['Title'];
        $chapterID= $row['chapter'];
        echo "<a href=viewChapterContent.php?id=$courseID&ch=$chapterID>Chapter $chapterID: $title </a> <br>"; 
        echo "<br>";
    }
}else{
    echo "<h2>Sorry, You have to be enrolled in this course to view this page</h2>";
}


?>