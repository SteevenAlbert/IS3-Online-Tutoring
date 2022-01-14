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
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isLearner();

$GLOBALS['conn'] = $conn;
$user = $_SESSION['UserID'];


echo "<div class='title-section'>";
echo "<h3 class='title'>My courses:</h3>";
echo "</div>";

//---------------------------- DISPLAY ENROLLED COURSES ---------------------------
$query2="SELECT * FROM courses c, enroll e where e.CourseID=c.CourseID AND e.UserID='$user'";
$result2=mysqli_query($conn,$query2);
try{
    if (!$result2){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
while($row = $result2->fetch_array(MYSQLI_ASSOC)){
    displayCourse($row);
    ?> 
    <a href=viewCourseContent.php?id=<?php echo $row['CourseID']?> class="btn btn-primary">Course Content </a> 
    </div></div>
<?php 
} 
?>

</div>
</div>

<?php
//------------------------ FUNCTION TO DISPLAY A SINGLE COURSE ---------------------------
function displayCourse($row)
{
    $thumbnail = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$row["Thumbnail"];

    // Display course details
    ?>

    <div class="card border-primary mb-3 course">
        <div class="row">
            <div class="col-lg-3">
                <img src=<?php echo $thumbnail?> width = 200>
            </div>
            <div class="col-lg-8">
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
            </div>
    <?php
    
}

?>