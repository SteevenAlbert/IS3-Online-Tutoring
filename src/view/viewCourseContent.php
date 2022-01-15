
<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isLearner();

?>

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
<link rel="stylesheet" href="../../CSS/courseContent.css" type="text/css">


<?php
$user=$_SESSION['UserID'];
$id = $_GET['id'];
$query = "SELECT * FROM enroll WHERE UserID ='$user' AND CourseID='$id'";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
$enrolled = mysqli_fetch_array($result);

if($enrolled){
    $getCoursesQuery = "SELECT * FROM courses WHERE CourseID=".$_GET["id"];
    $result = $conn->query($getCoursesQuery);
    try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }

    $row = $result->fetch_array(MYSQLI_ASSOC);
?>
<div class="container-fluid">
  <div class="Banner">
    <div class="BannerElements">
        <h1> <?php echo $row["Code"]." - ".$row["Title"] ?> </h1>
        <h5> <?php echo "Difficulty: <b>" . $row['Level'] ?></b></h5>
        <h3> <?php echo $row['Description']?> </h3>
     
        <h5> <?php echo "Created By: <b>" . getUsername($row['CreatedBy']) ?></b></h5>
    </div>
  </div>
</div>
    <div class="course-content">
    <h2> Course Content </h2>
    <ul class="list-group">
    <?php
      $id = $_GET["id"];
      $query = "SELECT * FROM coursechapters WHERE CourseID = '$id'";
      if(!$conn->query($query))
          echo mysqli_errno($conn).": " .mysqli_error($conn);
      $result = $conn->query($query);
      try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
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
}else{
    echo "<h2>Sorry, You have to be enrolled in this course to view this page</h2>";
}


?>