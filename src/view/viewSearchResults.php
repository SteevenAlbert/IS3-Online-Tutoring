


<link rel="stylesheet" href="../../CSS/courses.css" type="text/css">


<?php

session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
?>


 <!-- Main content -->
<div class = 'main-content col-lg-12'>
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
    die ("Query error. $getUserQuery");
elseif(mysqli_num_rows($result)<=0)
{
    echo "<div class='alert alert-info' role='alert'>
        <strong> Sorry! </strong> No results to show.
    </div>";
}
else{
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if (isset($_GET['category']))
        if ($row['Categories'] != $_GET['category'])
            continue;
        getRating($row, $averageRating, $reviewCount);
        
      
        displayCourse($row, $averageRating, $reviewCount);
        ?>
        </div></div></div>
    <?php
      
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

    <div class="card card-custom ">
        <div class="row">
            <div class="col-s-3">
                <img src=<?php echo $thumbnail?> width = 100>
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
                <h4 class="card-subtitle card-text2">
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


