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

isAuditor();
?>
<div class = "page-content">

<div class = "side-img col-lg-7">
<img src='/IS3-Online-Tutoring/uploads/backgroundImages/mail-man.png' width = 1000>
</div>

<div id="plist" class="people-list col-lg-4">
    <div class='row title-section'>
        <h3 class='title'>Chats:</h3>
    </div>
    <ul class="list-unstyled chat-list mt-2 mb-0">

<?php

$adminID = $_GET['admin'];

//-------------------------------- All users who chated with this admin ---------------------------
echo "<b>All chats for: ".getUsername($adminID). "</b> <br> <br>";

$query = "SELECT DISTINCT toUserID from messages WHERE fromUserID = '".$adminID ."'";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


while($row = $result->fetch_array(MYSQLI_ASSOC)){

    $target = getProfilePicture($row['toUserID']);
    echo "<a href = /IS3-Online-Tutoring/src/actions/auditor/auditorChat.php?learner=".$row['toUserID']."&admin=".$adminID.">";

    echo "<li class='clearfix'>";
    echo "<img src=$target alt='avatar'>";
    echo "<div class='about'>";
    echo "<div class='read-chat'>".getUsername($row['toUserID'])."</div>";
    echo "</div> </li>";
    echo "</a>";
}


//-------------------------------- All commented messages for this admin ---------------------------
$query = "SELECT m1.text as Comment, m2.text as Message from messages as m1, messages as m2 
WHERE m1.parentMessageID IS NOT NULL AND m1.toUserID = $adminID
AND m1.parentMessageID = m2.messageID";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


echo "<br> <br>  <br> <b> All comments </b> <br> <br>";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo "<b>Message: </b>".$row['Message']."<br>";
    echo "<b>Comment: </b>".$row['Comment']."<br><br>";
}

?>

</ul>
</div>

</div>