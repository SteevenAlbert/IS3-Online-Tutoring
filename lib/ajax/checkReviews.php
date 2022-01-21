<?php


include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$CourseID = $_POST['CourseID'];
$UserID = $_POST['UserID'];
$rating = $_POST['rating'];
$review = $_POST['review'];

$query = "SELECT * FROM ratings WHERE CourseID = '$CourseID' AND UserID='$UserID'" ;

$result = $conn->query($query);
if(!$result)
    throw new Exception($query);


$row = $result->fetch_array(MYSQLI_ASSOC);

if(!$row){ 
    if(isset($_POST['rating'])){
        $review = $conn->real_escape_string($_POST["review"]);
      
        $submitReviewQuery = "INSERT INTO ratings (CourseID, UserID, rating, review, date)
        VALUES ('$CourseID', '$UserID','$rating','$review', now())";
        
        if(!$conn->query($submitReviewQuery))
          throw new Exception($submitReviewQuery);
      
        //header('Location: /IS3-Online-Tutoring/src/view/viewCourseDetails.php?id='.$CourseID);
        echo "success";
      }
}


?>