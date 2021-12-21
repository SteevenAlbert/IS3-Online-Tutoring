<html>
<head>
<link rel="stylesheet" href="ratings.css" type="text/css">
</head>
<body>

<?php
 session_start();
 include_once "Menu.php";
 include_once "is3library.php";
 establishConnection();

/*-------Show Course Details-------*/
 $getCoursesQuery = "SELECT * FROM courses WHERE ID=".$_GET["id"];
 $result = $conn->query($getCoursesQuery);
 if (!$result)
 die ("Query error. $getUserQuery");

 $row = $result->fetch_array(MYSQLI_ASSOC)
?>

<?php echo "<h1>".$row["Code"]." - ".$row["Title"]."</h1>"?> </td>
<?php echo "Level: <b>".$row["Level"]."</b>"."&nbsp&nbsp&nbsp&nbsp&nbsp Hours: <b>".$row["Hours"]."</b>"?>
<?php echo "<p>".$row["Description"]."</p>"?>


<!-- REVIEW FORM -->
<?php if($_SESSION['UserType']=="Learner"){?>
<form method ="post" action = "">
<div class="container">
  <div class="feedback">
    <div class="rating">
      <input type="radio" name="rating" value=5 id="rating-5" >
      <label for="rating-5"></label>
      <input type="radio" name="rating" value=4 id="rating-4" >
      <label for="rating-4"></label>
      <input type="radio" name="rating" value=3 id="rating-3">
      <label for="rating-3"></label>
      <input type="radio" name="rating" value=2 id="rating-2">
      <label for="rating-2"></label>
      <input type="radio" name="rating" value=1 id="rating-1">
      <label for="rating-1"></label>
    </div>  
     <textarea class="review" id="review" name ="review" value="review"></textarea>
     <input type='submit' value="submit">
  </div>
</div>
</form>
<?php } ?>

<h2>Course Overview</h2>
<div class = "wrapper">
  <?php $query = "SELECT Overview FROM courses WHERE ID =".$_GET['id'];
       if(!$conn->query($query))
       echo mysqli_errno($conn).": " .mysqli_error($conn);
       else{
           $result = $conn->query($query);
           $row =  $result->fetch_array(MYSQLI_ASSOC);
       }
  ?>
<video src="CoursesContent\Videos\<?php echo $row['Overview']?>" autoplay controls> </video>

<h2> Chapters </h2>
<?php
    $id = $_GET["id"];
    $query = "SELECT * FROM coursechapters WHERE courseID= '$id'";
    if(!$conn->query($query))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    $result = $conn->query($query);
    $chaptersCount=0;
    while($row =$result->fetch_array(MYSQLI_ASSOC)){
        $chaptersCount+=1;
        $title=  $row['Title'];
        echo "<a href=viewChapter.php?id=$id&ch=$chaptersCount>Chapter $chaptersCount: $title </a>"; 
        echo "<br>";
}
?>

<!---------SHOW REVIEWS-----
<h2> Reviews </h2>
<div class="container2">
  <div class="feedback2">
    <?php/* for($j=5; $j>=1; $j--){
      echo "<div class=rating>";
        for($i=5; $i>=1; $i--){
          if($i==$j){
          echo "<input type=radio name=rating$j value=$i id=rating-$i checked>";
        }else{
          echo "<input type=radio name=rating$j value=$i id=rating-$i>";
        }
          echo "<label for=rating-$i></label>";
        }
        echo "<h3>$j</h3>";
      echo "</div>";  
      } */?>
  </div>
</div>->



<!---------CALCULATE AVERAGE RATING---------->
<?php
  $getReviewsQuery = "SELECT * FROM ratings WHERE courseID=".$_GET["id"];
  $reviews = $conn->query($getReviewsQuery);
  if (!$reviews)
    die ("Query error. $getReviewsQuery");
    $reviewCount=0;
    $reviewsTotal=0;
  while($review= $reviews->fetch_array(MYSQLI_ASSOC)){
    $reviewCount +=1; 
    $reviewsTotal+= $review['rating'];
  }
  if($reviewCount){
  $averageRating = round($reviewsTotal / $reviewCount, 1);
  echo "<h3>".$averageRating."/5<br></h3>";
}


  /*-------------Show Individual Reviews---------------*/
    $getCoursesQuery = "SELECT * FROM ratings WHERE courseID=".$_GET["id"];
    $result = $conn->query($getCoursesQuery);
    if (!$result)
       die ("Query error. $getCoursesQuery");
    while($row= $result->fetch_array(MYSQLI_ASSOC)){
      echo "<b>".$row['userName']."</b><br>";
      $name=$row['userName'];
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
      echo $row['review']."<br>";
      echo $row['date']."<br><br>";
    }
?>


<!-- SUBMIT REVIEW -->
<?php
if(isset($_POST['rating'])){
    $submitReviewQuery = "INSERT INTO ratings (courseID, userName, rating, review, date)
                          VALUES ('".$_GET["id"]."', '".$_SESSION["username"]."','".$_POST["rating"]."','".$_POST["review"]."', now())";
    if(!$conn->query($submitReviewQuery))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    
        header('Location: courseDetails.php?id='.$_GET['id']);
}
?>


</div>
</body>
</html>

