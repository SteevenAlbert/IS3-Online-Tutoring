<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
 establishConnection();
 ?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vquery/5.0.1/v.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../CSS/courses.css" type="text/css">
<link rel="stylesheet" href="../../CSS/ratings.css" type="text/css">
<link rel="stylesheet" href="../../CSS/courseDetails.css" type="text/css">


<script>
        $(document).ready(function(){
        $("#submit").click(function(e){
            e.preventDefault();
            var CourseID = <?php echo $_GET["id"]; ?>;
            var UserID = <?php echo $_SESSION['UserID'];?>;
            var review = $("#review").val().trim();
            var rating = "";
            var selected = $("input[type='radio'][name='rating']:checked");
            if (selected.length > 0) {
                rating = selected.val();
            }
            if(rating != ""){
                $.ajax({
                    url:'/IS3-Online-Tutoring/lib/ajax/checkReviews.php',
                    type:'post',
                    data:{UserID:UserID,CourseID:CourseID,rating:rating,review:review},
                    success:function(response){
                        var msg = response;     
                        $("#message").html(response);
                        if(response==="success"){
                            window.location = "viewCourseDetails.php?id=" + CourseID;
                        }else{
                          ShowAlert("Ops!", "You Already Reviewed This Course.", "warning");
                        }
                    }
             
                });
            }
        });
 

        $("#AddToCart").click(function(e){
            e.preventDefault();
            var CourseID = <?php echo $_GET["id"]; ?>;
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
          
        });
    });

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
</head>
<body>


<?php
//---------------------------------- Show Course Details ----------------------------------
$GLOBALS['conn'] = $conn;

 $getCoursesQuery = "SELECT * FROM courses WHERE CourseID=".$_GET["id"];
 $result = $conn->query($getCoursesQuery);
 if (!$result)
  throw new Exception($getCoursesQuery);

 $row = $result->fetch_array(MYSQLI_ASSOC);
?>
<div class="container-fluid">
  <div class="Banner">
    <div class="BannerElements">
        <h1> <?php echo $row["Code"]." - ".$row["Title"] ?> </h1>
        <h5> <?php echo "Difficulty: <b>" . $row['Level'] ?></b></h5>
        <h3> <?php echo $row['Description']?> </h3>
        <h4>
            <?php 
              $averageRating=5;
              $reviewCount=0;
            getRating($row, $averageRating, $reviewCount);
            echo "<span class='ratingSpan'>$averageRating</span>";
            for ($i = 0; $i < 5; $i++)
            {
                if ($i <= $averageRating-1)
                    echo "<span class='fa fa-star checked'></span>";
                else
                    echo "<span class='fa fa-star unchecked'></span>";
            }
            echo "<small class='text-muted'> <br><br>($reviewCount reviews)</small>";?>
        </h4>

        <h5> <?php echo "Created By: <b>" . getUsername($row['CreatedBy']) ?></b></h5>
    </div>
  </div>
  <div class="alert" role="alert" style="display:none;">
            <strong>Warning!</strong> 
            <p>Better check yourself, you're not looking too good.</p>
          </div>
  <!--Hovering Course Card-->
  <div class="card card-custom">
    <video class="card-img-top" src="/IS3-Online-Tutoring/resources/CoursesContent/Videos/<?php echo $row['Overview']?>" autoplay controls> </video>
      <div class="card-section1">
        <h1 class="card-title"><?php echo "E£".$row['Price']?></h1>
        <div class="card-body text-center">
        
          <?php
        if(isset($_SESSION['UserType'])){
            if($_SESSION['UserType']=="Learner"){?>
             <form action = '' method = 'post'>
                <input type =button name = "AddToCart" id="AddToCart" value = "Add To Cart" class="card-button">
            </form>     
            <?php } 
              }else{?>
                  <a href=/IS3-Online-Tutoring/src/public/loginForm.php?><button class="card-button" >Add To Cart</button></a>
              <?php } ?>
        <a href=""><button class="card-button" id="card-button2" >View Reviews</button></a>
        <p class="card-text">30-Day Money-Back Guarantee</p>
      </div>
      <h4> This course includes: </h4>
      <ul class="fa-ul">
        <li><span class="fa-li"><i class="far fa-file-video"></i></span><b><?php echo $row['Hours'] ?></b> hours on-demand video </li>
        <li><span class="fa-li"><i class="fas fa-code"></i></span>Practical Exercises</li>
        <li><span class="fa-li"><i class="fas fa-infinity"></i></span>Full lifetime access</li>
        <li><span class="fa-li"><i class="fas fa-desktop"></i></span>Full access on all platforms</li>
        <li><span class="fa-li"><i class="fas fa-trophy"></i></span>Certificate Of Completion</li>
      </ul>
    </div>
  </div>

  <div class="course-content">
    <h2> Course Content </h2>
    <ul class="list-group">
    <?php
      $id = $_GET["id"];
      $query = "SELECT * FROM coursechapters WHERE CourseID = '$id'";
      $result = $conn->query($query);
        if (!$result){
            throw new Exception($query); 
        }

      $chaptersCount=0;
      while($row =$result->fetch_array(MYSQLI_ASSOC)){
        $chaptersCount+=1;
        $title=  $row['Title'];
        echo "<li class='list-group-item list-group-item-action'>Chapter $chaptersCount: $title </a></li>"; 
      }
    ?>
    </ul>

    <?php
  $reviewsRating = array_fill(1,5,0);
  $getReviewsQuery = "SELECT * FROM ratings WHERE courseID=".$_GET["id"];
  $reviews = $conn->query($getReviewsQuery);
  if (!$reviews)
    throw new Exception($getReviewsQuery);

    $reviewCount=0;
    $reviewsTotal=0;
  while($review= $reviews->fetch_array(MYSQLI_ASSOC)){
    $reviewCount +=1; 
    $reviewsTotal+= $review['rating'];  
    $reviewsRating[$review['rating']] +=1; 
  }
  ?>


    <!---------SHOW REVIEWS----->
    <h2> Reviews </h2>
    <?php for($j=5; $j>=1; $j--){
      echo "<div class=showGeneralRating>";
        for($i=5; $i>=1; $i--){
          if($i==$j){
          echo "<input type=radio name=rating$j value=$i id=rating-$i checked>";
        }else{
          echo "<input type=radio name=rating$j value=$i id=rating-$i>";
        }
          echo "<label for=rating-$i></label>";
        }
        echo "<h6>$reviewsRating[$j] : </h6>";
      echo "</div>";  
      } ?>

        <!------------------------------------ REVIEW FORM --------------------------------------->
      <?php
        if(isset($_SESSION['UserID'])){
        $Query_enroll="SELECT * FROM enroll WHERE courseID=".$_GET['id']." AND UserID=".$_SESSION['UserID'];
        $result_Query=$conn->query($Query_enroll);
        if(!$result_Query){
          throw new Exception($Query_enroll);
        } 
 
        $row = mysqli_num_rows($result_Query);
        if($row!=0){      
           echo "<h4> Leave a Review </h4>";
         if($_SESSION['UserType']=="Learner"){
          ?>
      <form method ="post">
        <div class="feedback">
          <div class="rating">
            <input type="radio" name="rating" value=5 id="rating-05" >
            <label for="rating-05"></label>
            <input type="radio" name="rating" value=4 id="rating-04" >
            <label for="rating-04"></label>
            <input type="radio" name="rating" value=3 id="rating-03">
            <label for="rating-03"></label>
            <input type="radio" name="rating" value=2 id="rating-02">
            <label for="rating-02"></label>
            <input type="radio" name="rating" value=1 id="rating-01">
            <label for="rating-01"></label>
          </div>  
          <textarea class="review" id="review" name ="review" value="review"></textarea>
          <input type='button' class="card-button" name="submit" id="submit" value="submit">
        </div>
      </form>

          <?php } }  }?>

       
            <div class="individual-reviews">
        <?php
        //--------------------------------------- Show Individual Reviews -----------------------------------------*/
          $getCoursesQuery = "SELECT r.*,u.Username FROM ratings r, users u WHERE r.userID=u.userID AND CourseID=".$_GET["id"];
          $result = $conn->query($getCoursesQuery);
          if (!$result)
              throw new Exception($getCoursesQuery);
            while($row= $result->fetch_array(MYSQLI_ASSOC)){
              ?><div class="card card-custom2"> <?php  
              echo "<b>".$row['Username']."</b><br>";
              $name=$row['UserID'];
              ?>
              <div class="showRating">
              <?php 
              for($i=5; $i>=1; $i--){
                if($i==$row['rating']){
                ?>
                  <input type="radio" name="<?php echo $name ?> rating" value=$i id=<?php echo "Rating-$i"?> checked >
                  <label for=<?php echo "Rating-$i"?>></label>
                  <?php
                  }else{ ?>
                  <input type="radio" name="<?php echo $name ?> rating" value=$i id=<?php echo "Rating-$i"?> disabled >
                  <label for=<?php echo "$name-Rating-$i"?>></label>
                <?php  }
              }?>
            </div>  
            <?php
              echo "<h3>".$row['review']."<h3>";
              echo "<h5>".$row['date']."</h5>";
              echo "</div>";
           }
        ?>
  
    </div>
  </div>
</div>



<!----------------------------------------- SUBMIT REVIEW ----------------------------------------->
<?php


?>
</div>
</body>
</html>

<?php
function getRating($row, &$averageRating, &$reviewCount)
{
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
?>