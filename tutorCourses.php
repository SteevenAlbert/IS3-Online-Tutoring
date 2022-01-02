<?php
 session_start();
 include_once "Menu.php";
 include_once "is3library.php";
 
 establishConnection();

 //------------------------------ Get current tutor pending courses ------------------------------
 $getPendingCourses = "SELECT * FROM courses where Approved='0' and CreatedBy='".$_SESSION["UserID"]."'";
 $result = $conn->query($getPendingCourses);
 
 //------------------------------ Get current tutor approved courses ------------------------------
 $getApprovedCourses = "SELECT * FROM courses where Approved='1' and CreatedBy='".$_SESSION["UserID"]."'";
 $result2 = $conn->query($getApprovedCourses);

//------------------------------ Display current tutor pending courses ------------------------------
 echo "<br><br><br>";
 echo "<table border=3><th>Pending Courses</th></table>";
 displayCourses($result);

 //------------------------------ Display current tutor approved courses ------------------------------
 echo "<br><br><br>";
 echo "<table border=3><th>Approved Courses</th></table>";
 displayCourses($result2);

function displayCourses($result)
{
    if (!$result){
        die ("Query error. $getUserQuery");
    }
    else {
        
        echo "<table border=2 >
        <th>Code</th> 
        <th>Title</th> 
        <th>Description</th> 
        <th>Hours</th>  
        <th>Level</th>  
        <th>Price</th> 
        <th>Enrolled</th>
        <th>Content</th> 
        <th>Edit</th>
        <th>Delete</th> </tr>";
        while($row = $result->fetch_assoc()) {
            ?>
            <tr>
             <td> <a href=courseDetails.php?id=<?php echo $row['CourseID'] ?> > <?php echo$row["Code"]?></a> </td>
             <td><?php echo$row["Title"]?> </td>
             <td><?php echo$row["Description"]?> </td>
             <td><?php echo$row["Hours"]?> </td>
             <td><?php echo$row["Level"]?></td>
             <td><?php echo$row["Price"]?></td>
             <td> <a href=viewStudentsEnrolled.php?id=<?php echo $row['CourseID'] ?> > View</a></td>
             <td> <a href=addCourseContent.php?id=<?php echo $row['CourseID'] ?> > Edit Content</a></td>
             <td> <a href=editCourse.php?id=<?php echo $row['CourseID'] ?> > Edit</a></td>
             <td> <a href=deleteCourse.php?id=<?php echo $row['CourseID'] ?> >Delete</a></td>
            <?php
        }
        echo "</table>";
    }
}
?>
