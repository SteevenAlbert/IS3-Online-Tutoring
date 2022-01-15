<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../../CSS/ratings.css" type="text/css">
<link rel="stylesheet" href="../../CSS/courses.css" type="text/css">


<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";;
 
 establishConnection();

 isTutor();
 $GLOBALS['conn'] = $conn;

 //------------------------------ Get current tutor pending courses ------------------------------
 $getPendingCourses = "SELECT * FROM courses where Approved='0' and CreatedBy='".$_SESSION["UserID"]."'";
 $result = $conn->query($getPendingCourses);
 
 //------------------------------ Get current tutor approved courses ------------------------------
 $getApprovedCourses = "SELECT * FROM courses where Approved='1' and CreatedBy='".$_SESSION["UserID"]."'";
 $result2 = $conn->query($getApprovedCourses);


//------------------------------ Display current tutor pending courses ------------------------------
echo "<div class='title-section'>";
echo "<h3 class='title'>Pending Courses:</h3>";
echo "</div>";
 try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

    while($row = $result->fetch_assoc()) {
        displayCourse($row);
        ?>
        <div class="col-lg-3">
            <a href=/IS3-Online-Tutoring/src/model/Course/addCourseContent.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Add/Edit Content</a>
            <a href=/IS3-Online-Tutoring/src/model/Course/editCourse.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Edit/Delete Course</a>
             </div>
        </div>
        </div>
        <?php
    }

 //------------------------------ Display current tutor approved courses ------------------------------
 echo "<div class='title-section'>";
 echo "<h3 class='title'>Approved Courses:</h3>";
 echo "</div>";
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

    while($row = $result2->fetch_assoc()) {
        displayCourse($row);
        ?>
        <div class="col-lg-3">
                    
            <a href=/IS3-Online-Tutoring/src/view/viewStudentsEnrolled.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary"> Enrolled Learners</a>
            <a href=/IS3-Online-Tutoring/src/model/Course/addCourseContent.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Add/Edit Content</a>
            <a href=/IS3-Online-Tutoring/src/model/Course/editCourse.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Edit/Delete Course</a>

        </div>  
        </div>
        </div>
        <?php
    }


function displayCourse($row)
{
        $averageRating=5;
        $reviewCount=0;
        
        getRating($row, $averageRating, $reviewCount);

        $thumbnail = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$row["Thumbnail"];

        // Display course details
        ?>

        <div class="card border-primary mb-3 course">
            <div class="row">
                <div class="col-lg-3">
                    <img src=<?php echo $thumbnail?> width = 200>
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href=/IS3-Online-Tutoring/src/view/viewCourseDetails.php?id=<?php echo $row['CourseID'] ?> > <?php echo $row["Code"]." ".$row["Title"]?></a>
                        </h4>
                        <p class="card-text">
                            <?php echo$row["Description"]?> <br>
                            <small class="text-muted">
                                <?php echo$row["Level"]?>
                                <span class="dot"></span>
                                <?php echo$row["Hours"]." total hours"?><br> 
                                <i><?php echo getUsername($row["CreatedBy"])?></i><br> 
                            </small>
                        </p>
                    </div>
                
                    <h5 class="card-text">
                        <?php 
                        echo "EGP".$row["Price"]."<br>";
                        for ($i = 0; $i <= 5; $i++)
                        {
                            if ($i <= $averageRating)
                                echo "<span class='fa fa-star checked'></span>";
                            else
                                echo "<span class='fa fa-star unchecked'></span>";
                        }
                        echo "<small class='text-muted'> <br><br>($reviewCount reviews)</small>";?>
                    </h5>
                </div>
                
        <?php
        
}


function getRating($row, &$averageRating, &$reviewCount)
{
    $getReviewsQuery = "SELECT * FROM ratings WHERE CourseID=".$row["CourseID"];
    $reviews = $GLOBALS['conn']->query($getReviewsQuery);
    
    if (!$reviews)
        die ("Query error. $getReviewsQuery");

    $reviewsTotal=0;
    while($review= $reviews->fetch_array(MYSQLI_ASSOC)){
        $reviewCount +=1; 
        $reviewsTotal+= $review['rating'];
    }

    if($reviewCount)
        $averageRating = round($reviewsTotal / $reviewCount, 1);
}
?>
