
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

<link rel="stylesheet" href="../../CSS/ratings.css" type="text/css">
<link rel="stylesheet" href="../../CSS/courses.css" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/home.css" type="text/css">

<?php

session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";



//------------------------------------ Filter Results form ------------------------------------
$GLOBALS['maxPrice'] = 3000;
$GLOBALS['minRating'] = 0;
$GLOBALS['maxHours'] = 64;

if (isset($_POST['Filter']))
{
    if (isset($_POST['price']))
        $GLOBALS['maxPrice'] = $_POST['price'];
    if (isset($_POST['rating']))
        $GLOBALS['minRating'] = $_POST['rating'];
    if (isset($_POST['hours']))
        $GLOBALS['maxHours'] = $_POST['hours'];
}
?>


<div class='title-section'>
    <h3 class='title'>Our courses:</h3>
</div>

<div class = "page-content">

<div class = 'side-bar col-lg-2'>
<form action = '' method = 'post'>

        <!-- Price range section -->
        <div class = "section">
            <label for="form-range">Price (less than) in EGP:</label> <span id = "maxPrice"> </span>
            <input type="range" class="form-range" min="0" max="3000" step="100" id="priceRange" name = 'price' value =<?php echo $GLOBALS['maxPrice']?>>  
        </div>

        <!-- Rating section -->
        <div class = "section">
            <label for="rating-inline">Rating:</label><br>
            <?php 
                echo "<input class='form-check-input' type='radio' name='rating' value=1>";
                displayRating(1.0); echo "<p> 1.0 and up </p>";
                echo "<input class='form-check-input' type='radio' name='rating' value=2>";
                displayRating(2.0); echo "<p> 2.0 and up </p>";
                echo "<input class='form-check-input' type='radio' name='rating' value=3>";
                displayRating(3.0); echo "<p> 3.0 and up </p>";
                echo "<input class='form-check-input' type='radio' name='rating' value=4>";
                displayRating(4.0); echo "<p> 4.0 and up </p>";
            ?>
        </div>

        <!-- Hours range section -->
        <div class = "section">
            <label for="form-range">Hours (less than):</label> <span id = "maxHours"> </span>
            <input type="range" class="form-range" min="0" max="64" step="2" id="hoursRange" name = 'hours' value =<?php echo $GLOBALS['maxHours']?>>
            
        </div>

        <input  name='Filter' type='submit' class='btn btn-primary whitebtn' value ='Filter'>

</form>
</div>

 <!-- Main content -->
<div class = 'main-content col-lg-9'>
<?php
//------------------------------------ Database connection ------------------------------------
establishConnection();
$GLOBALS['conn'] = $conn;

$getCoursesQuery = "SELECT * FROM courses where Approved='1'";
$result = $conn->query($getCoursesQuery);

if (!$result)
    die ("Query error. $getUserQuery");
elseif (empty($_SESSION['UserID'])){
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        getRating($row, $averageRating, $reviewCount);
        
        if ($row['Price'] <= $GLOBALS['maxPrice'] && $averageRating >= $GLOBALS['minRating'] && $row['Hours'] <= $GLOBALS['maxHours'] )
        {
        displayCourse($row, $averageRating, $reviewCount);
        ?>
        </div></div></div>
    <?php
        }
    }
}
//------------------------------------ Display Approved courses for Learner ------------------------------------
else if($_SESSION["UserType"]=="Learner"){  
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        getRating($row, $averageRating, $reviewCount);
        
        if ($row['Price'] <= $GLOBALS['maxPrice'] && $averageRating >= $GLOBALS['minRating'] && $row['Hours'] <= $GLOBALS['maxHours'] )
        {
        displayCourse($row, $averageRating, $reviewCount);
        ?>
        <a href=viewApprovedCourses.php?id=<?php echo $row['CourseID']?> class="btn btn-primary"><i class="fas fa-shopping-cart icon"></i>Add To Cart</a>
        </div></div></div>
    <?php
        }
    }

}
//------------------------------------ Display Approved courses for tutor ------------------------------------
else if($_SESSION["UserType"]=="Tutor" && empty($_GET["id"]) ){
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        getRating($row, $averageRating, $reviewCount);

        if ($row['Price'] <= $GLOBALS['maxPrice'] && $averageRating >= $GLOBALS['minRating'] && $row['Hours'] <= $GLOBALS['maxHours']  )
        {
        displayCourse($row, $averageRating, $reviewCount);
        ?>     
        </div></div></div>
    <?php
        }
    }
}

//------------------------------------ Display pending courses to Administrator ------------------------------------
else if($_SESSION["UserType"]=="Administrator" || $_SESSION["UserType"]=="Auditor"){
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        getRating($row, $averageRating, $reviewCount);

        if ($row['Price'] <= $GLOBALS['maxPrice'] && $averageRating >= $GLOBALS['minRating'] && $row['Hours'] <= $GLOBALS['maxHours'] )
        {
        displayCourse($row, $averageRating, $reviewCount);
        ?>
        <a href=/IS3-Online-Tutoring/src/model/Course/editCourse.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Edit</a>
        <a href=/IS3-Online-Tutoring/src/model/Course/deleteCourse.php?id=<?php echo $row['CourseID'] ?> class="btn btn-primary">Delete</a>
        </div></div></div>

    <?php
        }
    }
}


//------------------------------------ Calculate rating ------------------------------------
function getRating($row, &$averageRating, &$reviewCount)
{
    $averageRating=5;
    $reviewCount=0;

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

function displayRating($rating)
{
    for ($i = 0; $i < 5; $i++)
    {
        if ($i <= $rating-1)
            echo "<span class='fa fa-star checked'></span>";
        else
            echo "<span class='fa fa-star unchecked'></span>";
    }
}

//------------------------------------ Display Course ------------------------------------
function displayCourse($row, $averageRating, $reviewCount)
{

    $thumbnail = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$row["Thumbnail"];

    // Display course details
    ?>

    <div class="card border-primary mb-3 course">
        <div class="row">
            <div class="col-lg-3">
                <img src=<?php echo $thumbnail?> width = 200>
            </div>
            <div class="col-lg-5">
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
            <div class="col-lg-4">
                <h4 class="card-subtitle">
                    <?php echo"EGP".$row["Price"]?><br>
                </h4>
                <h5 class="card-text">
                    <?php 
                    displayRating($averageRating);
                    echo "<small class='text-muted'> <br><br>($reviewCount reviews)</small>";?>
                </h5>


    <?php
    
}

?>

</div>
</div>

<?php
//------------------------------------ Add to Cart ------------------------------------
    if (isset($_GET['id']))
    {
        $user = $_SESSION['UserID'];
        $course = $_GET['id'];
        
        // check wether the course is already in the cart
        $message1="Course already in cart";
        $checkInCart= "SELECT CourseID FROM cartcourses WHERE UserID='".$user."' AND CourseID=".$course;
        $result_checkCart = mysqli_query($conn,$checkInCart);
        
        try{
            if (!$result_checkCart){
                throw new Exception("Error Occured"); 
            }
                        
        }catch(Exception $e){  
           echo"Message:", $e->getMessage();  
        }
        
        $row1 = mysqli_num_rows($result_checkCart);
        if($row1!=0){
            echo "<script>alert('$message1');</script>";
        }
        else
        {
            //check wether the learner already enrolled in this course
            $message2="You are already enrolled in this course";
            $checkInEnroll= "SELECT CourseID FROM enroll WHERE UserID='$user' AND CourseID=".$course;
            $result_checkEnroll = mysqli_query($conn,$checkInEnroll);
            try{
                if (!$result_checkEnroll){
                    throw new Exception("Error Occured"); 
                }
                            
            }catch(Exception $e){  
               echo"Message:", $e->getMessage();  
            }
        
            $row2 = mysqli_num_rows($result_checkEnroll);
            if($row2!=0){
                echo "<script>alert('$message2');</script>";
            }
            else{
                $insertCartQuery= "INSERT INTO cartcourses (UserID,CourseID) 
                VALUES ('".$user."','".$course."')";
        
                $result_insertCart = mysqli_query($conn,$insertCartQuery);
                try{
                    if (!$result_insertCart){
                        throw new Exception("Error Occured"); 
                    }
                                
                }catch(Exception $e){  
                   echo"Message:", $e->getMessage();  
                }
                
            }
        
        }
    }


?>


<script>
//------------------------------------ GET MAX PRICE FROM SLIDER ------------------------------------
    var priceSlider = document.getElementById("priceRange");
    var priceOutput = document.getElementById("maxPrice");
    priceOutput.innerHTML = priceSlider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    priceSlider.oninput = function() {
        priceOutput.innerHTML = this.value;
    }

    var hoursSlider = document.getElementById("hoursRange");
    var hoursOutput = document.getElementById("maxHours");
    hoursOutput.innerHTML = hoursSlider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    hoursSlider.oninput = function() {
        hoursOutput.innerHTML = this.value;
    }


</script>
