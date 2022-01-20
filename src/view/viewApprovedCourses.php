
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


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vquery/5.0.1/v.min.js"></script>

<link rel="stylesheet" href="../../CSS/courses.css" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<script>
function addToCart(courseID){
        var CourseID = courseID;
        var UserID = <?php echo $_SESSION['UserID'];?>;

        $.ajax({
            url:'/IS3-Online-Tutoring/lib/ajax/addToCart.php',
            type:'post',
            data:{UserID:UserID,CourseID:CourseID},
            success:function(response){
                var msg = response;     
                $("#message").html(response);
                if(response==="Success"){
                    ShowAlert("Congrats!", "Course Added To Cart", "success");
                }else{
                    ShowAlert("Ops!", response, "warning");
                }
            }
        });
    }

    function ShowAlert(msg_title, msg_body, msg_type) {
      var AlertMsg = $('div[role="alert"]');
      $(AlertMsg).find('strong').html(msg_title);
      $(AlertMsg).find('p').html(msg_body);
      $(AlertMsg).removeAttr('class');
      $(AlertMsg).addClass('alert-dismissible');
      $(AlertMsg).addClass('alert alert-' + msg_type);
      $(AlertMsg).show();
  }
</script>





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
<div class="alert" role="alert" style="display:none;">
<strong>Warning!</strong> 
<p>Better check yourself, you're not looking too good.</p>
</div>
</div>

 <!-- Main content -->
<div class = 'main-content col-lg-9'>
<?php
//------------------------------------ Database connection ------------------------------------
establishConnection();
$GLOBALS['conn'] = $conn;

if (empty($_GET['search']))
    $getCoursesQuery = "SELECT * FROM courses where Approved='1'";
else
{
    $search = $_GET['search'];
    $getCoursesQuery = "select * from courses where approved = 1 AND ( Code LIKE '%".$search.
    "%' OR Title LIKE '%".$search.
    "%' OR Description LIKE '%".$search.
    "%' OR Hours LIKE '%".$search.
    "%' OR Level LIKE '%".$search.
    "%' OR Price LIKE '%".$search.
    "%' OR CreatedBy LIKE '%".userIDSearch($search)."%')";
}
$result = $conn->query($getCoursesQuery);

if (!$result)
    throw new Exception($getCoursesQuery);
elseif(mysqli_num_rows($result)<=0)
{
    echo "<div class='alert alert-info' role='alert'>
        <strong> Sorry! </strong> No results to show.
    </div>";
}
elseif (empty($_SESSION['UserID'])){
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if (isset($_GET['category']))
        if ($row['Categories'] != $_GET['category'])
            continue;
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
        if (isset($_GET['category']))
        if ($row['Categories'] != $_GET['category'])
            continue;
        getRating($row, $averageRating, $reviewCount);
        
        if ($row['Price'] <= $GLOBALS['maxPrice'] && $averageRating >= $GLOBALS['minRating'] && $row['Hours'] <= $GLOBALS['maxHours'] )
        {
        displayCourse($row, $averageRating, $reviewCount);
        ?>
        <button onclick="addToCart(<?php echo $row['CourseID']?>)" class="btn btn-primary"><i class="fas fa-shopping-cart icon"></i>Add To Cart</button>
        </div></div></div>
    <?php
        }
    }

}
//------------------------------------ Display Approved courses for tutor ------------------------------------
else if($_SESSION["UserType"]=="Tutor" && empty($_GET["id"]) ){
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if (isset($_GET['category']))
        if ($row['Categories'] != $_GET['category'])
            continue;

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
        if (isset($_GET['category']))
        if ($row['Categories'] != $_GET['category'])
            continue;
            
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
        throw new Exception($getReviewsQuery);

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
