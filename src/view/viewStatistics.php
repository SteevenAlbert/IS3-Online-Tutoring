<html>
    <?php
     session_start();
     include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
     include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
     establishConnection();
     ?>
     <h1>Tutors Statistics</h1>

    <?php
/*---------------------------------------------------GET LEARNER NAME--------------------------------------------------*/
    $getTutorID = "SELECT * ,FirstName FROM survey,users WHERE survey.toTutorID=users.UserID GROUP BY toTutorID";
    $result = $conn->query($getTutorID);

    while($row = $result->fetch_assoc()) {
        $getSurveyCourseByID = "SELECT * FROM survey where toTutorID='".$row["toTutorID"]."'";
        $result2 = $conn->query($getSurveyCourseByID);
        if (!$result2){
        die ("Query error. $getSurveyCourseByID");
        }

/*----------------------------------------------Display Survey by Tutor ID-------------------------------------*/
        else{
                echo "<br>";
                echo "<table border=4 ><th>".$row["FirstName"]."</th></table>";
                echo "<table border=2 >
                     <th>Learner Username</th>
                     <th>Course  ID</th>
                     <th>Question 1</th>
                     <th>Question 2</th>
                     <th>Question 3</th>
                     <th>Question 4</th>
                     <th>Total Rating</th>
                     </tr>";
            while($row = $result2->fetch_assoc()) {                
                    ?>
                    <tr>
                    <td><?php echo getUsername($row["fromLearnerID"])?>    </td>
                    <td><?php echo$row["courseID"]  ?>    </td>
                    <td><?php echo$row["question1"] ?>    </td>
                    <td><?php echo$row["question2"] ?>    </td>
                    <td><?php echo$row["question3"] ?>    </td>
                    <td><?php echo$row["question4"] ?>    </td>
                    <?php $total=$row["question1"]+$row["question2"]+$row["question3"]+$row["question4"]?>
                    <td><?php echo $total/4?></td>
                    </tr>
                    <?php
            }
            echo "</table>";
        }
    } 
    
/*------------------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------------------------*/
    /*-----------------------------------------Enrolled Courses-----------------------------------*/    
?>
    <h1>Learners enrolled in Courses</h1>

    <?php
        $getCoursesQuery = "SELECT enroll.*,Title FROM enroll,courses WHERE enroll.CourseID=courses.CourseID GROUP BY CourseID";
        $result = $conn->query($getCoursesQuery);
        
        while($row = $result->fetch_assoc()) {
            $getCoursesbyCategory = "SELECT * FROM enroll where CourseID='".$row["CourseID"]."'";
        
        
            $result2 = $conn->query($getCoursesbyCategory);
        
            if (!$result2)
            die ("Query error. $getCoursesbyCategory");
        
            //------------------------------------ Display Courses by categorie ------------------------------------
            else{
                    echo "<br><br><br>";
                    echo "<table border=3 ><th>".$row["Title"]."</th></table>";
                    echo "<table border=1 >
                    <th>User ID</th> 
                    <th>Enroll Date</th> 
                    </tr>";
                while($row = $result2->fetch_assoc()) {                
                        ?>
                        <tr>
                        <td><?php echo getUsername($row["UserID"])?> </td>
                        <td><?php echo$row["EnrollDate"]?> </td>
                        <?php
                    
                }
                echo "</table>";
            }
        }
    ?>
 </html>