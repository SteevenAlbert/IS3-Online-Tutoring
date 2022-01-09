<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$user = $_SESSION['UserID'];

echo "<h1> Your Courses </h1>"; 
$query2="SELECT * FROM courses c, enroll e where e.CourseID=c.CourseID AND e.UserID='$user'";
$result2=mysqli_query($conn,$query2);
while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
    ?> <a href=viewCourseContent.php?id=<?php echo $rows['CourseID']?>><?php echo $rows['Title'] ?><br><br> </a> 
    <?php } 

?>