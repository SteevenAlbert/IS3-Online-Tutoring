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


<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/chat.css" type="text/css">

<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();
isAdmin();
?>


<div id="plist" class="people-list">
    <ul class="list-unstyled chat-list mt-2 mb-0">

<?php
//-------------------------------------------- Show all unread messages (latest first) --------------------------------------------
$query = "SELECT DISTINCT fromUserID FROM messages WHERE toUserID IS NULL AND isRead = 0 ORDER BY date DESC";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    echo "<a href = /IS3-Online-Tutoring/src/actions/adminstrator/adminChat.php?id=".$row['fromUserID'].">";
    echo "<li class='clearfix'>";
    echo "<img src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='avatar'>";
    echo "<div class='about'>";
    echo "<div class='unread-chat'>".getUsername($row['fromUserID'])."</div>";
    echo "</div> </li>";
    echo "</a>";

}


//-------------------------------------------- Show all read messages --------------------------------------------
$query = "SELECT DISTINCT m1.fromUserID FROM messages as m1 WHERE toUserID IS NULL 
AND NOT EXISTS (SELECT m2.fromUserID FROM messages as m2 WHERE m2.isRead = 0 AND m2.fromUserID = m1.fromUserID) ORDER BY date DESC";


$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<a href = /IS3-Online-Tutoring/src/actions/adminstrator/adminChat.php?id=".$row['fromUserID'].">";
    echo "<li class='clearfix'>";
    echo "<img src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='avatar'>";
    echo "<div class='about'>";
    echo "<div class='read-chat'>".getUsername($row['fromUserID'])."</div>";
    echo "</div> </li>";
    echo "</a>";
}
?>

</ul>
</div>