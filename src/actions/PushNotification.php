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
<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/pushNotification.css">

<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();

isAdminOrTutor();

//-------------------------------------------- Send Notification --------------------------------------------
if (isset($_POST['submit']))
{
    $query = "INSERT INTO Notifications(fromUserID, toUserID, CourseID,type, text, date) VALUES ('".$_SESSION['UserID']."','".$_GET['UserID']."', '".$_GET['CourseID']."', '".$_POST['NotificationType']."' ,'".$_POST['message']."', now())";
    $result = $conn->query($query);
    try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
}

//-------------------------------------------- Get Notifications history --------------------------------------------
$query = "SELECT * FROM Notifications WHERE fromUserID = '".$_SESSION['UserID']."' AND toUserID = '".$_GET['UserID']."'";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
?>

<div class="thiscontainer">
<?php
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    if ($row["FromUserID"]== $_SESSION['UserID'])
        echo "<b> You: </b> <br>";
    else
        echo "<b>".getUsername($row["FromUserID"]).": </b> <br>";

    if ($row['Text'] != NULL)
        echo $row["Text"]."<br>";

    if ($row['Link'] != NULL)
        echo "<a href='".$row['Link'] ."'>". $row['Link']."</a> <br>";
    echo date('H:i:s d-m-Y ', strtotime($row['Date']))."<br> <br>";
}
?>
</div>

<?php
//-------------------------------------------- Notification input --------------------------------------------
?>
<form action ='' method = 'post'>
<div class="dropdown">
<select name="NotificationType" id="NotificationType">
  <div class="dropdown-content">
    <option value="Survey">Survey</option>
    <option value="Assignment">Assignment</option>
  </div>
</select><br><br>
</div>
<br>
<div class="textbox">
<textarea name='message' rows='3' cols='100'> </textarea> &nbsp;<br>
</div>

<input class="btn btn-primary" type=submit name='submit'> 
</form>

<!-- <div class="suveyimg">
<img id="surveyimg" src="../../uploads/backgroundImages/survey.jpg">
</div> -->

