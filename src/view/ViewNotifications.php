<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();

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

    echo "<b> ".$name['Title']." </b> <br>";
    echo "<a href=survey.php?TutorID=".$row['FromUserID']."&CourseID=".$row['CourseID'].">".$row['Type']."</a><br>";
    echo $row["Text"]."<br>";

    if ($row['Link'] != NULL)
        echo "<a href='".$row['Link'] ."'>". $row['Link']."</a> <br>";
        
    echo date('H:i d-m-Y ', strtotime($row['Date']))."<br> <br>";
}
?>