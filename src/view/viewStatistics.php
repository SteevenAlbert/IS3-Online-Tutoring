<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../../CSS/view.css">

<html>
    <?php
     session_start();
     include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
     include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
     establishConnection();

     isAdmin();
?>
     
<div class="page-title">
    <h1>View Statistics </h1>
</div>



<?php
/*---------------------------------------------------GET LEARNER NAME--------------------------------------------------*/
    $getTutorID = "SELECT * ,FirstName FROM survey,users WHERE survey.toTutorID=users.UserID GROUP BY toTutorID";
    $result = $conn->query($getTutorID);
    try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
    while($row = $result->fetch_assoc()) {
        $getSurveyCourseByID = "SELECT * FROM survey where toTutorID='".$row["toTutorID"]."'";
        $result2 = $conn->query($getSurveyCourseByID);
        if (!$result2){
        die ("Query error. $getSurveyCourseByID");
        }

/*----------------------------------------------Display Survey by Tutor ID-------------------------------------*/
        else{

                echo "<div class = 'sub-title'><label>".$row["FirstName"]."</label> </div>";
                echo "<table class='table table-hover'>
                    <thead>
                    <tr>
                     <th class='text-center'>Learner Username</th>
                     <th class='text-center'>Course  ID</th>
                     <th class='text-center'>Question 1</th>
                     <th class='text-center'>Question 2</th>
                     <th class='text-center'>Question 3</th>
                     <th class='text-center'>Question 4</th>
                     <th>Total Rating</th>
                     </tr>
                     </thead>";
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
    <div class="page-title">
        <h1>Learners enrolled in Courses</h1>
    </div>

    <?php
        $getCoursesQuery = "SELECT enroll.*,Title FROM enroll,courses WHERE enroll.CourseID=courses.CourseID GROUP BY CourseID";
        $result = $conn->query($getCoursesQuery);
        try{
            if (!$result){
                throw new Exception("Error Occured"); 
            }
                        
        }catch(Exception $e){  
           echo"Message:", $e->getMessage();  
        }
        
        while($row = $result->fetch_assoc()) {
            $getCoursesbyCategory = "SELECT * FROM enroll where CourseID='".$row["CourseID"]."'";
        
        
            $result2 = $conn->query($getCoursesbyCategory);
            try{
                if (!$result2){
                    throw new Exception("Error Occured"); 
                }
                            
            }catch(Exception $e){  
               echo"Message:", $e->getMessage();  
            }
    
        
            //------------------------------------ Display Courses by categorie ------------------------------------
                    echo "<div class = 'sub-title'><label>".$row["Title"]."</label> </div>";
                    echo "<table class='table table-hover'>
                    <thead>
                    <tr>
                    <th class='text-center'>User ID</th> 
                    <th class='text-center'>Enroll Date</th> 
                    </tr> </thead";
                while($row = $result2->fetch_assoc()) {                
                        ?>
                        <tr>
                        <td><?php echo getUsername($row["UserID"])?> </td>
                        <td><?php echo$row["EnrollDate"]?> </td>
                        <?php
                    
                }
                echo "</table>";
            
        }
    ?>
 </html>