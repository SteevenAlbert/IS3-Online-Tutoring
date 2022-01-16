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

<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/cart.css" type="text/css">

<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isLearner();

if (isset($_GET["id"])) {
    Remove($conn);
}


//------------------------------------ Get Cart courses ------------------------------------
$user = $_SESSION['UserID'];
$query1="SELECT c1.title, c1.code, c1.Categories, c1.Hours, c1.CreatedBy, c1.Thumbnail, c1.price, c2.CourseID FROM courses c1,cartcourses c2 WHERE c2.CourseID=c1.CourseID AND c2.UserID='$user'";
$query2="SELECT SUM(price) FROM courses c1,cartcourses c2 WHERE c2.CourseID=c1.CourseID AND c2.UserID='$user'";
$result1=mysqli_query($conn,$query1);
$result2=mysqli_query($conn,$query2);
try{
    if (!$result1){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


try{
    if (!$result2){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
?>

<div class = "page-content"> 
    <div class="page-title">
		<h1>Shopping Cart</h1>
	</div>  
    <div class = "col-lg-8"> 
    <ul class = "courses-list">
    <label> Courses </label>

<?php
//------------------------------------ Display Cart Courses ------------------------------------
while($rows = $result1->fetch_array(MYSQLI_ASSOC)){
    $target = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$rows['Thumbnail'];

    ?>
    <li class = "row">
        <div class="col-lg-4">
            <img src=<?php echo $target?> height = 100>
        </div>
        <div class="col-lg-5">
            <p class="text-muted"> <?php echo $rows['Categories']?> </p>
            <label> <?php echo $rows['code'].$rows["title"]?> </label>
            <p class="text-muted"> <?php echo getUsername($rows["CreatedBy"]);?> </p>
            <p class="text-muted"> <?php echo $rows["Hours"]." hours"?> </p>
            <?php 
            getRating($rows, $averageRating, $reviewCount);
            displayRating($averageRating); 
            ?>
            
        </div>
        <label class = 'col-lg-2'> EGP <?php echo $rows['price']?> </label>
        <a class="col-lg-1" href=cart.php?id=<?php echo$rows["CourseID"]?>><i class="fas fa-times"></i></a>
    </li>
 <?php
}
?>

</ul>
</div>



<?php
//------------------------------------ Remove course from cart ------------------------------------
function Remove($conn) {
    $get_id = $_GET["id"];
    $user = $_SESSION['username'];
    //delte from cart
    $sql1= "DELETE FROM cartcourses WHERE CourseID=".$get_id;
    $sql2= "DELETE FROM ordercourses WHERE CourseID=".$get_id;
    $result_sql1=mysqli_query($conn,$sql1);
    $result_sql2=mysqli_query($conn,$sql2);
    try{
        if (!$result_sql1){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }

    try{
        if (!$result_sql2){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
}


//------------------------------------ Display total price ------------------------------------
?>
<div class='col-lg-2'>
    <?php
    $total=0;
    $numberOfCourses = mysqli_num_rows($result1);
    echo "<input hidden type = text name = 'amount' value = $numberOfCourses><br>";

    while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
        foreach($rows as $row)
        echo "<label> Total </label>";
        echo "<div class = 'total-price'> EGP $row </div>";
        $total=$row;
    }
    echo"<br>";
    ?>
    <a href="/IS3-Online-Tutoring/src/actions/learner/enroll.php?amount=<?php echo $numberOfCourses?>&total=<?php echo $total?>" class="btn btn-primary button2">CHECKOUT</a>
</div>
</div>


<?php
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
?>