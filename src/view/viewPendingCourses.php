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

isAdmin();

//------------------------------ Approve selected courses ------------------------------ 
if(isset($_POST['Approve'])){
      
    if(!empty($_POST['courses'])) {    
        foreach($_POST['courses'] as $value){
            $updatePending="update courses set Approved='1' where CourseID='".$value."'";
            
            $result4=mysqli_query($conn,$updatePending);
            if (!$result4){
                throw new Exception($updatePending); 
            }
        }
    }
            
}

//------------------------------ Get pending courses ------------------------------ 
$getCoursesQuery = "SELECT * FROM courses where Approved='0'";
$result = $conn->query($getCoursesQuery);
if (!$result){
    throw new Exception($getCoursesQuery); 
}

 //--------------------------- Display all pending courses -------------------------
echo "<div class='title-section'>";
echo "<h3 class='title'>Approve Courses:</h3>";
echo "</div>";

if($_SESSION["UserType"]=="Administrator" || $_SESSION["UserType"]=="Auditor"){
    echo "<form action ='' method = 'post'>";
    echo "<div class='overlay-section'> <input  name='Approve' type='submit' class='btn btn-primary' value ='Approve'> </div>";
    echo "<div class = 'checkbox-group'>";
    while($row = $result->fetch_assoc()) {
        
        $thumbnail = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$row["Thumbnail"];

    // Display course details
    ?>

    <div class="card border-primary mb-3 course clickable-course">
        <div class="row form-check">
            <div class="checkbox-section col-lg-1">
                <input hidden class="form-check-input" type="checkbox" value=<?php echo$row["CourseID"]?> name = "courses[]">    
            </div>
            <div class="col-lg-3">
                <img src=<?php echo $thumbnail?> width = 200>
            </div>
            <div class="col-lg-4">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $row["Code"]." ".$row["Title"]?>
                    </h4>
                    <p class="card-text">
                        <?php 
                        echo$row["Description"]."<br>";
                        echo$row["Categories"]."<br>";?>

                        <small class="text-muted">
                            <?php echo$row["Level"]?>
                            <span class="dot"></span>
                            <?php echo$row["Hours"]." total hours"?><br> 
                            <i><?php echo getUsername($row["CreatedBy"])?></i><br> 
                        </small>
                    </p>
                </div>
            </div>
            <div class="col-lg-3">
                <a href=/IS3-Online-Tutoring/src/model/Course/editCourse.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Edit/Delete</a>
            </div>
        </div>
    </div>


    <?php
    }
    
    echo "</div></form>";
}

?>



<script>
    //------------------------------ TOGGLE ON CLICK (checkbox logic) ------------------------------ 
    $(document).ready(function () {
        $('.checkbox-group .course').click(function () {
        $(this).toggleClass('selected');
        $(this).find('.row .checkbox-section .form-check-input').prop("checked", !$(this).find('.row .checkbox-section .form-check-input').prop("checked"));
    });

    })

</script>