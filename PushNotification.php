<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

//-------------------------------------------- Send Notification --------------------------------------------
if (isset($_POST['submit']))
{
    $query = "INSERT INTO Notifications(fromUserID, toUserID, CourseID,type, text, date) VALUES ('".$_SESSION['UserID']."','".$_GET['UserID']."', '".$_GET['CourseID']."', '".$_POST['NotificationType']."' ,'".$_POST['message']."', now())";
    $result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");
}

//-------------------------------------------- Get Notifications history --------------------------------------------
$query = "SELECT * FROM Notifications WHERE fromUserID = '".$_SESSION['UserID']."' AND toUserID = '".$_GET['UserID']."'";
$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");


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

//-------------------------------------------- Notification input --------------------------------------------
?>
<form action ='' method = 'post'>
<select name="NotificationType" id="NotificationType">
    <option value="Survey">Survey</option>
    <option value="Assignment">Assignment</option>
</select><br><br>
<textarea name='message' rows='3' cols='100'> </textarea> &nbsp;<br>
<input type=submit name='submit'> 
</form>

