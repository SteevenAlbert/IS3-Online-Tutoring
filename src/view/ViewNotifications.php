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
<link rel="stylesheet" href="../../CSS/notification.css">
<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();

isLearner();

?>
<div class="notify"><h2>Notification</h2></div>
<?php
//---------------------------------GET NOTIFICATIONS-------------------------------------------
$getNotificationsQuery = "SELECT * FROM Notifications where ToUserID='".$_SESSION['UserID']."'";
$result = $conn->query($getNotificationsQuery);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

//---------------------------------SHOW NOTIFICATIONS-------------------------------------------
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    //getCourseName
    $getCourseName = "SELECT Title FROM courses where CourseID='".$row['CourseID']."'";
    $CourseNameResult = $conn->query($getCourseName);
    try{
        if (!$CourseNameResult){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
    $name = $CourseNameResult->fetch_array(MYSQLI_ASSOC);
    
?>
<div class="blocks">
<span class="open"><?php echo $name['Title']?></span>
<div class="gameData">
    <div class="words">
 <?php  echo "<a href=survey.php?TutorID=".$row['FromUserID']."&CourseID=".$row['CourseID'].">".$row['Type']."</a><br>";
 echo $row["Text"]."<br>";
 if ($row['Link'] != NULL)
    echo "<a href='".$row['Link'] ."'>". $row['Link']."</a> <br>";
echo date('H:i d-m-Y ', strtotime($row['Date']))."<br>";?>
</div>
</div>
</div>
<br>
 <?php

}
?>


<script>
$(document).ready(function() {
  jQuery('.open').on('click', function() {
    jQuery('.gameData').slideUp('fast');
    jQuery(this).next('.gameData').slideDown('fast');
  });
});
</script>

